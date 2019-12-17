# Install

## Description

Test if there is a README.md or README_#LANGABBR#.mb in the module folder. If yes, the system display the Markdown file 
in the modules section as new tab.

Module was created for Oxid 6.1

This is the "README_de.md" file.

## Install
1. Copy files into following directory
        
        source/modules/rs/markdown
        
2. Add to composer.json at shop root
  
        "autoload": {
            "psr-4": {
                "rs\\markdown\\": "./source/modules/rs/markdown"
            }
        },

3. Refresh autoloader files with composer.

        composer dump-autoload
        
4. Enable module in the oxid admin area, Extensions => Modules