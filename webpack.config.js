var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')

    .setPublicPath('/build')

    .addStyleEntry('styles', './assets/css/app.scss')

    // .copyFiles({from: './assets/images'})

    .autoProvidejQuery()

    .enableSassLoader()

    .enableVueLoader()

    // .addEntry('app', './assets/js/index.js')

    .addEntry('landing', './assets/js/modules/landing/landing.js')

    // .addEntry('userSettings', './assets/js/modules/user_settings/userSettings.js')

    // .addEntry('sidebar', './assets/js/modules/dashboard/sidebar/sidebar.js')

    .addEntry('main', './assets/js/modules/dashboard/main/main.js')

    .configureCssLoader(options => {
        // options.modules = true;
    })

    .enableBuildNotifications()

    .enableSourceMaps(!Encore.isProduction())

    .cleanupOutputBeforeBuild()

    .enableVersioning(Encore.isProduction())

    .splitEntryChunks()

    .enableSingleRuntimeChunk()

// only needed for CDN's or sub-directory deploy
//.setManifestKeyPrefix('build/')

// uncomment if you use API Platform Admin (composer req api-admin)
//.enableReactPreset()
//.addEntry('admin', './assets/js/admin.js')

;

module.exports = Encore.getWebpackConfig();
