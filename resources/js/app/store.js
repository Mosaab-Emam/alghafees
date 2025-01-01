import { configureStore } from '@reduxjs/toolkit'
import { setupListeners } from '@reduxjs/toolkit/query'
import { api } from '../query'
import rateRequestFormReducer from './slices/rateRequestFormSlice'

export const store = configureStore({
  reducer: {
    [api.reducerPath]: api.reducer,
    rateRequestForm: rateRequestFormReducer,
  },
  middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(api.middleware),
})

setupListeners(store.dispatch)
