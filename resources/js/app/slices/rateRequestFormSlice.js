import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  name: '',
  mobile: '',
  email: '',
  address: '',
  goal_id: '',
  notes: '',
  type_id: '',
  real_estate_details: '',
  entity_id: '',
  real_estate_age: '',
  real_estate_area: '',
  usage_id: '',
  latitude: '',
  longitude: '',
  location: '',
  instrument_image: [],
  construction_license: [],
  other_contracts: []
};

const rateRequestFormSlice = createSlice({
  name: 'rateRequestForm',
  initialState,
  reducers: {
    updateFormField: (state, action) => {
      const { field, value } = action.payload;
      state[field] = value;
    },
    addDocument: (state, action) => {
      const { type, file } = action.payload;
      state[type].push(file);
    },
    removeDocument: (state, action) => {
      const { type, index } = action.payload;
      state[type] = state[type].filter((_, i) => i !== index);
    },
    resetForm: () => initialState,
  },
});

export const {
  updateFormField,
  addDocument,
  removeDocument,
  resetForm,
} = rateRequestFormSlice.actions;

export default rateRequestFormSlice.reducer; 