const webpack = require('webpack');
const path = require('path');
const Dotenv = require('dotenv-webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
  watch: process.env.WATCH === 'true',
  watchOptions: { ignored: ['vendor', 'node_modules'] },
  entry: { main: './assets_src/js/index.js' },
  output: {
    path: path.resolve(__dirname, './assets'),
    filename: 'js/main.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: { loader: 'babel-loader' }
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { url: false }
          },
          'postcss-loader',
          'sass-loader'
        ]
      }
    ]
  },
  plugins: [
    new Dotenv(),
    new webpack.ProgressPlugin(),
    new CleanWebpackPlugin({ cleanOnceBeforeBuildPatterns: ['css', 'images', 'js'] }),
    new CopyWebpackPlugin([
      { from: './assets_src/admin', to: 'admin' },
      { from: './assets_src/images', to: 'images' },
      { from: './assets_src/*.*', flatten: true, ignore: ['index.js'] }
    ], { copyUnmodified: true }),
    new MiniCssExtractPlugin({ filename: 'css/main.css' })
  ]
};
