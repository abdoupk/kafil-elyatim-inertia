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
            member_id: '',
            formatted_specification: {
                label: 'monthly_sponsorship',
                value: 'monthly_sponsorship'
            },
            formatted_member: {
                id: '',
                name: ''
            }
        }
    }),
    actions: {
        async getFinancialTransaction(financialTransactionId: string) {
            const {
                data: { financialTransaction }
            } = await axios.get(`financial/show/${financialTransactionId}`)

            this.financialTransaction = { ...financialTransaction }

            this.financialTransaction.formatted_specification = {
                label: financialTransaction.specification,
                value: financialTransaction.specification
            }
        }
    }
})
