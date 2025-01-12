import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';

export const api = createApi({
  reducerPath: 'api',
  baseQuery: fetchBaseQuery({
    prepareHeaders: (headers) => {
      headers.set('Accept', 'application/json');
      return headers;
    },
  }),
  endpoints: (builder) => ({
    // Rate Requests
    submitRateRequest: builder.mutation({
      query: ({ body, url }) => ({
        url,
        method: 'POST',
        body,
        formData: true,
      }),
    }),
  }),
})

export const { useSubmitRateRequestMutation } = api
