import { table } from './table.js';
import { importProcess } from './importProcess.js';

export const transactions = {
    namespaced: true,

    modules: {
        table,
        importProcess
    }
}