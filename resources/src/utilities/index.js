const utilities = {
  formatIdCard(idCard) {
    return new Intl.NumberFormat('de-DE').format(idCard);
  },
};

export default utilities;
