import {useState, useEffect} from 'react';
import axios from 'axios';
import { useNavigation } from '@react-navigation/native'
import AsyncStorage from '@react-native-async-storage/async-storage';

import {Link} from '../controllers/Link';

export default ({children}) => {
	const [isLogin, setIsLogin] = useState(true);
	const navigation = useNavigation();

	useEffect(() => {
		
		async function auth () {

			try {
				const Token = await AsyncStorage.getItem('token');
				const Auth = await axios.post(`${Link}/api/auth/me`, {}, {
					headers: {
						'Authorization': `Bearer ${Token}`
					}
				});

				console.log(Token);
				setIsLogin(true);
				navigation.replace('Dashboard');
			} catch (Err) {
				setIsLogin(false);
			}
		}

		auth()

	}, [])


	if(!isLogin) {
		return children;
	} else {
		return null;
	}
}