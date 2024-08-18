import type { CreateFinancialTransactionForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    financialTransaction: CreateFinancialTransactionForm & {
        id?: string
        formatted_specification?: {
            label: string
            value: string
        }
        formatted_member?: {
            id: string
            name: string
        }
        creator?: {
            id: string
            name: string
        }
        readable_date?: string
        readable_created_at?: string
        receiver?: {
            id: string
            name: string
        }
    }
}

export const useFinancialTransactionsStore = defineStore('financialTransactions', {
    state: (): State => ({
        financialTransaction: {
            id: '',
            specification: 'monthly_sponsorship',
            amount: null,
            date: new Date(),
            description: '',
            type: 'income',
            member_id: ''
        }
    }),
    actions: {
        async getFinancialTransaction(financialTransactionId: string) {
            const {
                data: { financialTransaction }
            } = await axios.get(route('tenant.financial.show', financialTransactionId))

            this.financialTransaction = { ...financialTransaction }
        },

        async getFinancialTransactionDetails(financialTransactionId: string) {
            const { data } = await axios.get(route('tenant.financial.details', financialTransactionId))

            this.financialTransaction = data.transaction
        }
    }
})
