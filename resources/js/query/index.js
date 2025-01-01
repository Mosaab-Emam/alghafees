import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';

export const api = createApi({
  reducerPath: 'api',
  baseQuery: fetchBaseQuery({
    baseUrl: import.meta.env.VITE_API_ROOT || 'http://localhost:8000/api/',
    prepareHeaders: (headers) => {
      headers.set('Accept', 'application/json');
      return headers;
    },
  }),
  endpoints: (builder) => ({
    // Categories
    getGoals: builder.query({
      query: () => 'categories/goals',
    }),
    getTypes: builder.query({
      query: () => 'categories/types',
    }),
    getEntities: builder.query({
      query: () => 'categories/entities',
    }),
    getUsages: builder.query({
      query: () => 'categories/usages',
    }),

    // Rate Requests
    submitRateRequest: builder.mutation({
      query: (formData) => ({
        url: 'rate-requests',
        method: 'POST',
        body: formData,
        formData: true,
      }),
    }),
  }),
})

export const { useGetGoalsQuery, useGetTypesQuery, useGetEntitiesQuery, useGetUsagesQuery, useSubmitRateRequestMutation } = api
