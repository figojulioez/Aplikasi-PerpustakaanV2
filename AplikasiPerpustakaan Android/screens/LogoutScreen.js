import { View, Text, TouchableOpacity, TextInput, ScrollView, ActivityIndicator } from 'react-native'
import React, {useState, useEffect } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import { StatusBar } from 'expo-status-bar';
import axios from 'axios';
import {Link} from '../controllers/Link';
import AsyncStorage from '@react-native-async-storage/async-storage';
import AntDesign from '@expo/vector-icons/AntDesign';
import FontAwesome5 from '@expo/vector-icons/FontAwesome5';

import Animated, { FadeInDown } from 'react-native-reanimated';
import CategoryKomponen from './Komponen/CategoryKomponen';
import { Image } from 'expo-image';
import {useDispatch} from 'react-redux';
import { store } from '../redux/buku/Buku';
import {useSelector} from 'react-redux';


export default function LoginScreen() {
  const navigation = useNavigation();

  useEffect(() => {
    const keluar = async function () {
      try {
        const Token = await AsyncStorage.getItem('token');
        const Logout = await axios.post(`${Link}/api/auth/keluar`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        await AsyncStorage.removeItem('token');
        navigation.navigate('Login');

      } catch (Err) {
      } finally {
      } 
    }

    keluar();

  }, [])


  return  <Text>Anda Sedang Logout</Text>
}
