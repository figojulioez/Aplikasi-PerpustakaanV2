import {configureStore} from '@reduxjs/toolkit';
import user from './user/User.js';
import buku from './buku/Buku.js';

const store = configureStore({
	reducer: {
		user: user, buku: buku
	}
});

export default store;