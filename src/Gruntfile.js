// -------------------------------------------------------
// Gruntfile.js for Sergio Costa's projects
// Version: 2.0.0
//
// Author:  Sergio Costa
// URL:     http://www.equilibradigital.com
// Contact: sergio@equilibradigital.com
// -------------------------------------------------------
"use strict";

module.exports = function(grunt) {

    // Para instalar matchdep na pasta src do projeto: $ npm install matchdep
    require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    var projectConfig = {

        // Setting Directories
        dirs: {
            app:  "../",
            js:   "../assets/js",
            sass: "../assets/sass",
            css:  "../assets/css",
            img:  "../assets/images"
        },

        // Metadata
        pkg: grunt.file.readJSON("package.json"),
        banner:
        "\n" +
        "/*\n" +
         "* -------------------------------------------------------\n" +
         "* Project: <%= pkg.title %>\n" +
         "* Version: <%= pkg.version %>\n" +
         "*\n" +
         "* Author:  <%= pkg.author.name %>\n" +
         "* URL:     <%= pkg.author.url %>\n" +
         "* Contact: <%= pkg.author.email %>\n" +
         "*\n" +
         "*\n" +
         "* Copyright (c) <%= grunt.template.today*(\"yyyy\")%> <%= pkg.author.name %>\n" +
         "* -------------------------------------------------------\n" +
         "*/\n" +
         "",

        // Watch 
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-watch --save-dev
        watch: {
            options: {
                livereload: true
            },
            compass: {
                files: [
                    "<%= dirs.css %>/{,*/}*.css",
                    "<%= dirs.sass %>/{,*/}*.{scss,sass}"
                ],
                tasks: ["compass", "notify:compass"]
            },
            js: {
                files: [
                    "<%= jshint.all %>"
                ],
                tasks: ["jshint", "uglify", "notify:js"]
            },
            html: {
                files: [
                    // supported files: html, htm, shtml, shtm, xhtml, php, jsp, asp, aspx, erb, ctp
                    "<%= dirs.app %>/*.{html,htm,shtml,shtm,xhtml,php,jsp,asp,aspx,erb,ctp}"
                ]
            }
        },

        // JShint
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-jshint --save-dev
        jshint: {
            options: {
                jshintrc: ".jshintrc"
            },
            all: [
                "Gruntfile.js",
                "../assets/js/main.js"
            ]
        },

        // Uglify
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-uglify --save-dev
        uglify: {
            options: {
                mangle: false,
                banner: "<%= banner %>"
            },
            dist: {
                files: {
                    // Main JS
                    "<%= dirs.js %>/main.min.js": [
                    "<%= dirs.js %>/main.js"
                    ],

                    // External Plugins
                    "<%= dirs.js %>/plugins.min.js": [
                    "<%= dirs.js %>/plugins.js"
                    ]
                }
            }
        },

        // Compass
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-compass --save-dev
        compass: {
            dist: {
                options: {
                    sassDir: '../assets/sass',
                    cssDir: '../assets/css',
                    environment: "development",
                    outputStyle: "compact",
                    force: true,
                    config: "config.rb"
                }
            }
        },

        // Concat
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-concat --save-dev
        concat: {
            options: {
              separator: ';'
            },
            dist: {
              src: ['../assets/css/normalize.css', '../assets/css/foundation.css', '../assets/css/plugins.css', '../assets/css/style.css', '../assets/css/mediasqueries.css'],
              dest: '../assets/css/style.css'
            },
        },

        // Minify CSS
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-cssmin --save-dev
        cssmin: {
          add_banner: {
            options: {
              banner: '/* Author custom styles for Geo Turismo minified file. */'
            },
            files: {
              '../style.min.css': ['../style.css']
            }
          }
        },

        // Notify
        // Para instalar na pasta src do projeto: $ npm install grunt-notify --save-dev
        notify: {
          compass: {
            options: {
              title: "SASS - <%= pkg.title %>",
              message: "Compilado e minificado com sucesso!"
            }
          },
          js: {
            options: {
              title: "Javascript - <%= pkg.title %>",
              message: "Minificado e validado com sucesso!"
            }
          },
          image: {
            options: {
              title: "<%= pkg.title %>",
              message: "Imagens minificadas!"
            }
          }
        },

        // Image Optimization
        // Para instalar na pasta src do projeto: $ npm install grunt-contrib-imagemin --save-dev
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 3,
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: "<%= dirs.img %>/",
                    src: "<%= dirs.img %>/**",
                    dest: "<%= dirs.img %>/"
                }]
            }
        }

    };

    // Init Grunt
        grunt.initConfig(projectConfig);


    // Register Tasks
    // ----------------

    // Watch Project - $ grunt
    grunt.registerTask( "default", [ "watch" ]);

    // Grunt GUI - $ grunt gui
    grunt.loadNpmTasks('grunt-peon-gui');

    // Uglify js - $ grunt u
    grunt.registerTask( "u", [ "uglify" ]);

    // Minify CSS - $ grunt cssmin
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Concat - $ grunt concat
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Optimize the images files - $ grunt o
    grunt.registerTask( "o", [ "imagemin" ]);


};