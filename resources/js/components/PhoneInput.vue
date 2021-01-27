<template>
	<VuePhoneNumberInput
	id="phoneNumber"
	v-model="phoneValue"
	color="dodgerblue"
	:dark="dark"
	:disabled="disabled"
	:default-country-code="defaultCountry"
	:loader="hasLoaderActive"
	:required="true"
	clearable
	:error="hasErrorActive"
	class="mb-2"
	/>
</template>
<script>
	import VuePhoneNumberInput from 'vue-phone-number-input';
	VuePhoneNumberInput.props.required = true;
	export default {
		components: {
			VuePhoneNumberInput
		},
		props:['phoneValue','defaultCountry'],
		data() {
			return {
				phoneValue:"",
				defaultCountry: 'ID',
				translations: {
					countrySelectorLabel: 'Code pays',
					countrySelectorError: 'Choisir un pays',
					phoneNumberLabel: 'Numéro de téléphone',
					example: 'Exemple :'
				},
				results: {},
				dark: false,
				disabled: false,
				hasLoaderActive: false,
				hasErrorActive: false
			}
		},
		created(){
			console.log(this);
		},
	}
</script>