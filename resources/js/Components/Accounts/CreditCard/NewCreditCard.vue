<template>
  <div class="grid grid-cols-1 gap-4 sm:col-span-6 sm:grid-cols-6">
    <div class="sm:col-span-6">
      <label for="name" class="block text-sm font-medium leading-5 text-gray-700"> Name </label>
      <div class="mt-1 rounded-md shadow-sm">
        <input
          id="name"
          v-model="form.name"
          type="text"
          :class="{ 'border-red-500': !validations.name.valid }"
          class="block w-full rounded-md border-gray-300 shadow-sm"
        />
      </div>
      <span
        v-show="!validations.name.valid"
        class="text-sm text-red-500"
        v-text="validations.name.message"
      ></span>
    </div>
    <div class="sm:col-span-6">
      <label for="number" class="block text-sm font-medium leading-5 text-gray-700"> Number </label>
      <div class="mt-1 rounded-md shadow-sm">
        <input
          id="number"
          v-model="form.number"
          :class="{ 'border-red-500': !validations.number.valid }"
          type="text"
          class="block w-full rounded-md border-gray-300 shadow-sm"
        />
      </div>
      <span
        v-show="!validations.number.valid"
        class="text-sm text-red-500"
        v-text="validations.number.message"
      ></span>
    </div>
    <div class="sm:col-span-6">
      <label for="institution" class="block text-sm font-medium leading-5 text-gray-700">
        Institution
      </label>
      <div class="mt-1 rounded-md shadow-sm">
        <select
          id="institution"
          v-model="form.institution"
          :class="{ 'border-red-500': !validations.institution.valid }"
          class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
        >
          <option value=""></option>
          <option
            v-for="(institution, key) in institutions"
            :key="'institution-' + key"
            :value="institution.id"
            v-text="institution.name"
          />
        </select>
      </div>
      <span
        v-show="!validations.institution.valid"
        class="text-sm text-red-500"
        v-text="validations.institution.message"
      ></span>
    </div>
    <div class="sm:col-span-6">
      <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
        Description
      </label>
      <div class="mt-1 rounded-md shadow-sm">
        <input
          id="description"
          v-model="form.description"
          :class="{ 'border-red-500': !validations.description.valid }"
          type="text"
          class="block w-full rounded-md border-gray-300 shadow-sm"
        />
      </div>
      <span
        v-show="!validations.description.valid"
        class="text-sm text-red-500"
        v-text="validations.description.message"
      ></span>
    </div>
    <div class="sm:col-span-3">
      <div>
        <label for="interest-rate" class="block text-sm font-medium text-gray-700">
          Interest Rate
        </label>
        <div class="mt-1 flex rounded-md shadow-sm">
          <span
            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm"
          >
            %
          </span>
          <input
            id="interest-rate"
            v-model="form.interest_rate"
            type="text"
            name="interest-rate"
            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
          />
        </div>
        <span
          v-show="!validations.interest_rate.valid"
          class="text-sm text-red-500"
          v-text="validations.interest_rate.message"
        ></span>
      </div>
    </div>
    <div class="sm:col-span-3">
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">
          Current Balance
        </label>
        <div class="mt-1 flex rounded-md shadow-sm">
          <span
            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm"
          >
            $
          </span>
          <input
            id="current-balance"
            v-model="form.current_balance"
            type="text"
            name="current-balance"
            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
          />
        </div>
        <span
          v-show="!validations.current_balance.valid"
          class="text-sm text-red-500"
          v-text="validations.current_balance.message"
        ></span>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import CreditCardAPI from '@/api/creditCards.js';

export default {
  props: ['institutions'],

  data() {
    return {
      form: {
        name: '',
        number: '',
        institution: '',
        description: '',
        interest_rate: '',
        current_balance: '',
      },

      validations: {
        name: {
          valid: true,
          message: 'Enter a name for this account',
        },
        number: {
          valid: true,
          message: 'Please enter an account number',
        },
        institution: {
          valid: true,
          message: 'Please select the institution that provides your account.',
        },
        description: {
          valid: true,
          message: 'Please enter a description',
        },
        interest_rate: {
          valid: true,
          message: 'Enter the interest rate for your loan',
        },
        current_balance: {
          valid: true,
          message: 'Enter the current balance of your account',
        },
      },
    };
  },

  mounted() {
    EventBus.on('add-credit-card', () => {
      this.add();
    });

    EventBus.on('reset-form', () => {
      this.resetForm();
    });

    EventBus.on('reset-validations', () => {
      this.resetValidations();
    });
  },

  methods: {
    add() {
      if (this.validate()) {
        CreditCardAPI.store(this.form)
          .then((message) => {
            this.notify();
            this.reloadAccounts();
            this.resetForm();
            this.resetValidations();
            this.hideModal();
          })
          .catch((error) => {
            this.setServerSideValidations(error.response.data.errors);
          });
      }
    },

    validate() {
      let validAccount = true;

      if (this.form.name == '') {
        validAccount = false;
        this.validations.name.valid = false;
      } else {
        this.validations.name.valid = true;
      }

      if (this.form.number == '') {
        validAccount = false;
        this.validations.number.valid = false;
      } else {
        this.validations.number.valid = true;
      }

      if (this.form.description == '') {
        validAccount = false;
        this.validations.description.valid = false;
      } else {
        this.validations.description.valid = true;
      }

      if (this.form.institution == '') {
        validAccount = false;
        this.validations.institution.valid = false;
      } else {
        this.validations.institution.valid = true;
      }

      if (this.form.interest_rate == '') {
        validAccount = false;
        this.validations.interest_rate.valid = false;
      } else {
        this.validations.interest_rate.valid = true;
      }

      if (this.form.current_balance == '') {
        validAccount = false;
        this.validations.current_balance.valid = false;
      } else {
        this.validations.current_balance.valid = true;
      }

      return validAccount;
    },

    notify() {
      EventBus.emit('notify', {
        type: 'success',
        title: 'Account Added',
        message: 'You can now add transactions, set goals, and budget for this account!',
        action: 'close',
      });
    },

    reloadAccounts() {
      EventBus.emit('reload-accounts');
    },

    resetForm() {
      this.form.name = '';
      this.form.number = '';
      this.form.institution = '';
      this.form.description = '';
      this.form.interest_rate = '';
      this.form.current_balance = '';
    },

    resetValidations() {
      this.validations.name.valid = true;
      this.validations.number.valid = true;
      this.validations.institution.valid = true;
      this.validations.description.valid = true;
      this.validations.interest_rate.valid = true;
      this.validations.current_balance.valid = true;
    },

    hideModal() {
      EventBus.emit('close-modal');
    },

    setServerSideValidations(errors) {
      for (const [key, value] of Object.entries(errors)) {
        this.validations[key].valid = false;
        this.validations[key].message = value[0];
      }
    },
  },
};
</script>
