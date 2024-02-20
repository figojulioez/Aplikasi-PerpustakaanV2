import {useState, useEffect} from 'react';
import axios from 'axios';
import { useNavigation } from '@react-navigation/native'
import AsyncStorage from '@react-native-async-storage/async-storage';
import {useDispatch} from 'react-redux';
import { store } from '../redux/user/User';

import {Link} from '../controllers/Link';

export default ({children}) => {
	const [isLogin, setIsLogin] = useState(false);
	const navigation = useNavigation();
	const dispatch = useDispatch();

	useEffect(() => {
		
		async function auth () {

			try {
				const Token = await AsyncStorage.getItem('token');
				const Auth = await axios.post(`${Link}/api/auth/me`, {}, {
					headers: {
						'Authorization': `Bearer ${Token}`
					}
				});
				
				dispatch(store({result: Auth.data.message}));
				setIsLogin(true);

			} catch (Err) {
				setIsLogin(false);
				navigation.replace('Welcome');
				
			}
		}

		auth()

	}, [])

	if(isLogin) {
		return children;
	} else {
		return null;
	}
}