const path = require('path');
const webpack = require('webpack');

module.exports = {
  mode:'development',
  entry: {
    main: './index.js',
    },
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'dist/views/js'),
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        Popper: ['popper.js', 'default'],
      })
  ]
};