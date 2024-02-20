import { createSlice } from '@reduxjs/toolkit';

const bukuSlice = createSlice({
  name: 'buku',
  initialState: { result: [] },
  reducers: {
    store: (state, action) => {
      state.result.push(action.payload.result);
    },
    destroy: (state, action) => {
      state.result = [];
    },
    hapus: (state, action) => {
      state.result.splice(action.payload.result, 1);
    },
  },
});

export const { store, destroy, hapus } = bukuSlice.actions;
export default bukuSlice.reducer;
