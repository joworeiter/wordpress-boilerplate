#!/bin/bash

. $(dirname $0)/load-env.sh

# ensure ssh keys are mapped to ddev
ddev auth ssh
ddev exec "wp @production db export - | wp db import - && wp search-replace \"\"$WP_HOME_PROD\"\" \"\"$WP_HOME\"\""
ddev exec npm --prefix theme run build
ddev exec wp rewrite flush
rsync -chav --delete "$SSH":"$REMOTE_UPLOAD_DIR" shared/assets/
rsync -chav --delete "$SSH":"$REMOTE_PLUGIN_DIR" app/site/content/plugins

