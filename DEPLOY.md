# Deploying Matterello (DigitalOcean + GitHub Actions)

Same setup as Evercrest: one Ubuntu droplet, one Linux user per site, code deploys on `git push`.
Full background and the server bootstrap live in Evercrest's `self-hosting.md` (Steps 1–5).

**Code** (`themes/matterello`) deploys from git. **Content** (pages, posts, images, enquiries)
lives on the server and is never touched by a deploy.

| Placeholder | Means |
|---|---|
| `SERVER_IP` | the droplet's IP |
| `matterello.example.com` | the domain or subdomain for this site |
| `you` | your sudo login on the droplet |

## 1. Server (once)

- **Reusing the Evercrest droplet:** the stack and the `new-site` script are already there. Skip to step 2.
- **New droplet:** Ubuntu 24.04, 2 GB RAM, add your SSH key, then follow Evercrest `self-hosting.md` Steps 2–5.

## 2. Create the site

DNS: an A record for `matterello.example.com` → `SERVER_IP` (not needed if a wildcard `*` record already exists).

```bash
sudo new-site matterello matterello.example.com
```

## 3. Move the Studio site up (once)

On your PC (PowerShell):

```powershell
cd C:\Users\ocamp\Studio\matterello
studio export matterello.sql --mode db
C:\Windows\System32\tar.exe -czf matterello-files.tgz -C wp-content themes/matterello uploads
scp matterello.sql matterello-files.tgz you@SERVER_IP:/tmp/
```

Never upload `db.php`, `database/` or `mu-plugins/`: they're Studio's SQLite setup and would break MySQL.

On the server:

```bash
sed -i 's/utf8mb4_0900_ai_ci/utf8mb4_unicode_ci/g' /tmp/matterello.sql
sudo -u matterello -H bash -c '
  cd ~/public
  tar -xzf /tmp/matterello-files.tgz -C wp-content
  wp db import /tmp/matterello.sql
  wp search-replace "http://localhost:8888" "https://matterello.example.com" --all-tables
  wp theme activate matterello
  wp rewrite flush
'
rm /tmp/matterello.sql /tmp/matterello-files.tgz
sudo -u matterello -H wp user update admin --prompt=user_pass --path=/home/matterello/public   # Studio's password is known locally
```

## 4. CI/CD (once)

1. Allow the deploy key for the `matterello` user only (key pair is `~/.ssh/matterello_actions` on the PC):
   ```powershell
   scp $env:USERPROFILE\.ssh\matterello_actions.pub you@SERVER_IP:/tmp/
   ```
   ```bash
   sudo -u matterello -H bash -c 'mkdir -p ~/.ssh && chmod 700 ~/.ssh && cat /tmp/matterello_actions.pub >> ~/.ssh/authorized_keys && chmod 600 ~/.ssh/authorized_keys'
   rm /tmp/matterello_actions.pub
   ```
2. GitHub → repo **Settings → Secrets and variables → Actions**:
   - **Secrets** tab → `DEPLOY_KEY`: full contents of `~/.ssh/matterello_actions` (the private file, not `.pub`)
   - **Secrets** tab → `SERVER_IP`: the droplet IP
3. **Actions** tab → **Deploy Matterello** → **Run workflow** to test.

✅ The run goes green, and a small change pushed to `main` shows up on the live site.
