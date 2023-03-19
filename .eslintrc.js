const lintStatus = 0; // "warn", 0, 1

module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    "plugin:vue/vue3-recommended",
    "plugin:vue/vue3-essential",
    "@vue/eslint-config-prettier",
    "airbnb-base"
  ],
  globals: {
    "Atomics": "readonly",
    "SharedArrayBuffer": "readonly",
    "ga": true
  },
  overrides: [],
  parserOptions: {
    ecmaVersion: "latest",
    sourceType: "module",
  },
  plugins: [
    "vue",
    "html",
    "prettier"
  ],
  ignorePatterns: [
    "**/node_modules",
    "**/vendor"
  ],
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "warn" : 0,
    "no-debugger": process.env.NODE_ENV === "production" ? "warn" : 0,
    "comma-dangle": lintStatus,
    "consistent-return": lintStatus,
    "default-case": lintStatus,
    "eqeqeq": lintStatus,
    "func-names": lintStatus,
    "global-require": lintStatus,
    "implicit-arrow-linebreak": lintStatus,
    "import/extensions": lintStatus,
    "import/no-dynamic-require": lintStatus,
    "import/no-unresolved": lintStatus,
    "import/prefer-default-export": lintStatus,
    "indent": lintStatus,
    "max-len": lintStatus,
    "no-bitwise": lintStatus,
    "no-cond-assign": lintStatus,
    "no-multi-assign": lintStatus,
    "no-use-before-define": lintStatus,
    "no-undef": lintStatus,
    "no-unused-vars": lintStatus,
    "no-param-reassign": lintStatus,
    "no-plusplus": lintStatus,
    "no-redeclare": lintStatus,
    "no-restricted-globals": lintStatus,
    "no-underscore-dangle": lintStatus,
    "no-var": lintStatus,
    "object-curly-newline": lintStatus,
    "operator-linebreak": lintStatus,
    "prefer-destructuring": lintStatus,
    "prettier/prettier": lintStatus,
    "radix": lintStatus,
    "vue/multi-word-component-names": lintStatus,
    "vue/no-arrow-functions-in-watch": lintStatus,
    "vue/no-deprecated-v-on-native-modifier": lintStatus,
    "vue/no-mutating-props": lintStatus,
    "vue/no-unused-components": lintStatus,
    "vue/no-unused-vars": lintStatus,
    "vue/no-template-shadow": lintStatus,
    "vue/no-reserved-component-names": lintStatus,
    "vue/no-v-html": lintStatus,
    "vue/order-in-components": lintStatus,
    "vue/require-default-prop": lintStatus,
    "vue/require-explicit-emits": lintStatus,
    "vue/require-v-for-key": lintStatus,
    "vue/require-prop-types": lintStatus,
    "vue/return-in-computed-property": lintStatus
  },
};
