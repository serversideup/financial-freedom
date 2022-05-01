export const FormatCSVImport = {
    methods: {
        formatCSVImport( pending ){
            this.pendingTransactions = [];

            for( let i = 0; i < pending.length; i++ ){
                if( pending[i].Name != undefined ){
                    let transaction = {
                        import: true,
                        name: pending[i].Name,
                        raw_name: pending[i].Name,
                        description: '',
                        amount: pending[i].Amount,
                        direction: pending[i].Transaction == 'DEBIT' ? 'outflow' : 'inflow',
                        date: pending[i].Date,
                        tags: '',
                        category: '',
                        potential_duplicate: null,
                        imported: false
                    };

                    transaction = this.applyRules( transaction );

                    this.pendingTransactions.push( transaction );
                }
            }
        },
        
        applyRules( transaction ){
            let cleanTransaction = transaction;

            for( let i = 0; i < this.rules.length; i++ ){
                if( cleanTransaction.name.search( this.rules[i].find ) > -1 ){
                    cleanTransaction.name = cleanTransaction.name = this.rules[i].replace;
                    cleanTransaction.category = this.rules[i].category ? this.rules[i].category : '';
                }
            }

            return cleanTransaction;
        }
    }
}