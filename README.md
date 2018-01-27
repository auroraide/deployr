# deployr

Very stupid continuous deployment script for Aurora.

## Usage

- Set a secret `DEPLOY_KEY` environment variable in GitLab CI settings and edit `config.json` accordingly
- Upload your WAR file to your __deployr__ server like this

```bash
curl -F 'war=@/path/to/aurora.war' "https://aurora.younishd.fr:4000?key=$DEPLOY_KEY"
```
