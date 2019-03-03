# Log Rotate
Rotate Magento Log Files inside ./var/log/ folder.

Magento generates too much log data and it becmes hard to handle them if they become so large in size. So here i developed a module that rotates log files. You can use this module to rotate log files every day at night or whatever time you prefer. Also, you can define minimum file size to be rotated. I used studio24/rotate module and integrated than in Magento.

# Installation
```sh
composer require gulshankumar/log-rotate
```
If you are installing this module manually then you must run below as a dependency of this module

```sh
composer require studio24/rotate
```
