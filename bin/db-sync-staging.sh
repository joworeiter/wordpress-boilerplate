#!/bin/bash

. $(dirname $0)/load-env.sh

# ensure ssh keys are mapped to ddev
ddev auth ssh
ddev exec "wp @staging db export - | wp db import - && wp search-replace \"\"$WP_HOME_STAGING\"\" \"\"$WP_HOME\"\""
ddev exec npm --prefix theme run build
ddev exec wp rewrite flush
rsync -chav --delete "$SSH":"$REMOTE_UPLOAD_DIR_STAGING" shared/assets/

