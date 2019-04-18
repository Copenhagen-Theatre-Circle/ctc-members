# Stop syncing a node_modules directory (via symlink)
noicloud() {
        mv node_modules node_modules.nosync
        ln -s node_modules.nosync/ node_modules
}
alias nocloud=noicloud
