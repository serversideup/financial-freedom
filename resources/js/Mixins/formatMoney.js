export const FormatMoney = {
  methods: {
    formatMoney(amount, c, d, t) {
      let n = amount;
      var c = isNaN((c = Math.abs(c))) ? 2 : c;
      var d = d == undefined ? '.' : d;
      var t = t == undefined ? ',' : t;
      const s = n < 0 ? '-' : '';
      const i = String(parseInt((n = Math.abs(Number(n) || 0).toFixed(c))));
      var j = (j = i.length) > 3 ? j % 3 : 0;
      return `$${s}${j ? i.substr(0, j) + t : ''}${i
        .substr(j)
        .replace(/(\d{3})(?=\d)/g, `$1${t}`)}${
        c
          ? d +
            Math.abs(n - i)
              .toFixed(c)
              .slice(2)
          : ''
      }`;
    },
  },
};
