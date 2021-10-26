export const USBankChecking = {
    methods: {
        formatTransactions( pending ){
            this.pendingTransactions = [];

            for( let i = 0; i < pending.length; i++ ){
                if( pending[i].Name != undefined ){
                    let transaction = {
                        import: true,
                        name: pending[i].Name.replace('DEBIT PURCHASE', '').replace('WEB AUTHORIZED PMT', ''),
                        description: '',
                        amount: pending[i].Amount,
                        direction: pending[i].Transaction == 'DEBIT' ? 'outflow' : 'inflow',
                        date: pending[i].Date,
                        tags: [],
                        category: '',
                        potential_duplicate: null,
                        imported: false
                    }

                    this.pendingTransactions.push( transaction );
                }
            }
        }
    }
}