import axios from 'axios';
import {Link} from './Link';
import AsyncStorage from '@react-native-async-storage/async-storage';
import {useDispatch} from 'react-redux';
import { store } from '../redux/user/User';

export default () => {
	const login = async (email, password, setErrorEmail, setErrorPassword, navigation) => {

		try {
			const Authentication = await axios.post(`${Link}/api/auth/masuk`, {email, password});
			const Token = Authentication.data.message;
			await AsyncStorage.setItem('token', Token);
			navigation.replace('Dashboard');
		} catch (Err) {
			const {password, email} = Err.response.data.message;
			setErrorPassword(password);
			setErrorEmail(email);
		}
	}

	const create = async (username, email, namaLengkap, alamat, password, setErrorUsername, setErrorEmail, setErrorNamaLengkap, setErrorAlamat, setErrorPassword, navigation) => {
		try {
			const Authentication = await axios.post(`${Link}/api/auth/buat`, {username, email, namaLengkap, alamat,password});
			navigation.replace('Login');
		} catch (Err) {
			const {password, email, username, alamat, namaLengkap} = Err.response.data.message;
			setErrorPassword(password);
			setErrorEmail(email);
			setErrorUsername(username);
			setErrorAlamat(alamat);
			setErrorNamaLengkap(namaLengkap);
		}

	}

	const ganti = async (username, email, namaLengkap, alamat, password, konfirmasiPassword, setErrorUsername, setErrorEmail, setErrorNamaLengkap, setErrorAlamat, setErrorPassword, setErrorKonfirmasiPassword, navigation) => {
	try {
        const Token = await AsyncStorage.getItem('token');
        const Authorization = {headers: {'Authorization' : `Bearer ${Token}`}};
		const Authentication = await axios.post(`${Link}/api/auth/ganti`, {username, email, namaLengkap, alamat,password, konfirmasiPassword}, Authorization);
		navigation.replace('Dashboard');
	} catch (Err) {
		const {password, email, username, alamat, namaLengkap, konfirmasiPassword} = Err.response.data.message;
		setErrorPassword(password);
		setErrorKonfirmasiPassword(konfirmasiPassword);
		setErrorEmail(email);
		setErrorUsername(username);
		setErrorAlamat(alamat);
		setErrorNamaLengkap(namaLengkap);
	}
};


	return { login, create, ganti }

}