# Nextcloud HMR Enabler

[![PHPUnit GitHub Action](https://github.com/nextcloud/hmr_enabler/workflows/PHPUnit/badge.svg)](https://github.com/nextcloud/hmr_enabler/actions?query=workflow%3APHPUnit)
[![Node GitHub Action](https://github.com/nextcloud/hmr_enabler/workflows/Node/badge.svg)](https://github.com/nextcloud/hmr_enabler/actions?query=workflow%3ANode)
[![Lint GitHub Action](https://github.com/nextcloud/hmr_enabler/workflows/Lint/badge.svg)](https://github.com/nextcloud/hmr_enabler/actions?query=workflow%3ALint)

This app unblock hot module replacement requests for webpack apps.

## Try it

To install it change into your Nextcloud's apps directory:

    cd nextcloud/apps

Then run:

    git clone https://github.com/nextcloud/hmr_enabler.git

Install the dependencies using:

    make composer
