import { View, Text, TouchableOpacity, TextInput, ScrollView, ActivityIndicator, StyleSheet } from 'react-native'
import React, {useState, useEffect } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import { StatusBar } from 'expo-status-bar';
import axios from 'axios';
import {Link} from '../controllers/Link';
import AsyncStorage from '@react-native-async-storage/async-storage';
import FontAwesome5 from '@expo/vector-icons/FontAwesome5';
import AntDesign from '@expo/vector-icons/AntDesign';
import { BarCodeScanner } from 'expo-barcode-scanner';
import Animated, { FadeInDown } from 'react-native-reanimated';

import CategoryKomponen from './Komponen/CategoryKomponen';
import { Image } from 'expo-image';
import {useDispatch} from 'react-redux';
import { store, destroy } from '../redux/buku/Buku';
import {useSelector} from 'react-redux';


export default function LoginScreen() {
  const navigation = useNavigation();
  const dispatch = useDispatch()
  const dataBukus = useSelector(state => state.buku.result);
  const [error, setError] = useState('');
  const [hasPermission, setHasPermission] = useState(null);
  const [scanned, setScanned] = useState(false);
  const [status, setStatus] = useState(false);

  useEffect(() => {
    const getBarCodeScannerPermissions = async () => {
      const { status } = await BarCodeScanner.requestPermissionsAsync();
      setHasPermission(status === 'granted');
    };

    const cekStatus = async function () {
      try {
        const Token = await AsyncStorage.getItem('token');
        const cek = await axios.post(`${Link}/api/buku/cekStatus`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        if (cek.data.message == true) {
          navigation.navigate('PinjamBuku');
        }
      } catch (Err) {
        console.log(Err);
      } finally {
      } 
    }

    cekStatus();

    getBarCodeScannerPermissions();
  }, [])

  const handleBarCodeScanned = ({ type, data }) => {
    
    const pinjam = async () => {
      try {
        const Token = await AsyncStorage.getItem('token');
        const DataBuku = await axios.post(`${Link}/api/buku/scanned`, {dataBukus}, {headers: {'Authorization' : `Bearer ${Token}`}});
        navigation.replace('PinjamBuku');
                        
      } catch (Err) {
        setError(Err.response.data.message);
      } finally {
      }
    }

    if ( data === 'Aplikasi Perpustakaan dibuat oleh MamiezFigoez' ) {
      pinjam();
      dispatch( destroy() );
      setScanned(true);
    }
  
  };

  if (hasPermission === null) {
    return <Text className="w-100 mt-5 text-xl text-center font-bold">Meminta izin kamera</Text>;
  }
  if (hasPermission === false) {
    return <Text className="w-100 mt-5 text-xl text-center font-bold">Tidak ada akses kamera</Text>;
  }

  return (
    <View className="flex-1 bg-white" style={{backgroundColor: 'white'}}>
    <StatusBar hidden={true} />


      <SafeAreaView  className="flex pt-4" style={{backgroundColor: themeColors.bg}}>
        <View className="flex-row justify-start mt-2 border-b-8 border-y-stone-200 pb-5 items-stretch">
          <TouchableOpacity onPress={()=> navigation.goBack()} 
          className="bg-yellow-400 p-2 rounded-xl ml-2">
            <ArrowLeftIcon size="20" color="black" />
          </TouchableOpacity>
          <View className="w-9/12 px-2 ml-3">
            <Text className="text-slate-50 text-2xl font-semibold antialiased text-center">Peminjaman Buku</Text>
          </View>
        </View>

      </SafeAreaView>


      <View 
        style={{}} 
        className="flex-1 bg-white px-3 pt-5">

      { error && 
      <View className=" bg-red-200 pb-6 px-3 py-2 mb-2">
        <Text className="text-center text-red-700 font-bold text-base">{error} !!!</Text>
      </View>      
      }

      <View className="rounded flex-1">
      <BarCodeScanner
        onBarCodeScanned={scanned ? undefined : handleBarCodeScanned}
        style={StyleSheet.absoluteFillObject}
        className="rounded-xl"
      />
      </View>
      </View>
       { dataBukus.length > 0 &&
      <View className="flex-row bg-slate-200 justify-center pb-6 px-3 py-2">
          <TouchableOpacity className='flex-row items-center' onPress={() => {setScanned(false) }}>
            <AntDesign name="scan1" className="" size={36} color="green" />
            <Text className="text-base text-center text-stone-950 font-bold px-5"> Tekan tombol untuk scan ulang </Text>
          </TouchableOpacity>
      </View>
    }
    </View>

  )
}

