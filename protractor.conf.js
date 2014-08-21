exports.config = {
  sauceUser: process.env.SAUCE_USERNAME,
  sauceKey: process.env.SAUCE_ACCESS_KEY,

  capabilities: {
    'browserName': 'chrome',
    'tunnel-identifier': process.env.TRAVIS_JOB_NUMBER,
    'build': process.env.TRAVIS_BUILD_NUMBER,
    'name': 'Test triggered by Git push'
  },

  // Spec patterns are relative to the current working directly when
  // protractor is called.
  specs: ['test/e2e/basic.spec.js'],
  baseUrl: 'localhost',
  // Options to be passed to Jasmine-node.
  mochaOpts: { }
};
