import {createSlice} from '@reduxjs/toolkit';

const user = createSlice({
	name: 'user',
	initialState: [],
	reducers: {
		store: function(state, action) {
			state.splice(0,1,action.payload.result);
		},
	}

});

export const {store} = user.actions;
export default user.reducer;