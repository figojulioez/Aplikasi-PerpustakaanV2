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
import FontAwesome5 from '@expo/vector-icons/FontAwesome5';
import AntDesign from '@expo/vector-icons/AntDesign';

import Animated, { FadeInDown } from 'react-native-reanimated';
import CategoryKomponen from './Komponen/CategoryKomponen';
import { Image } from 'expo-image';
import {useDispatch} from 'react-redux';
import { store } from '../redux/buku/Buku';
import { hapus } from '../redux/buku/Buku';
import {useSelector} from 'react-redux';


export default function LoginScreen() {
  const navigation = useNavigation();
  const dispatch = useDispatch()
  const dataBukus = useSelector(state => state.buku.result);
  const [maxData, setMaxData] = useState([]);
  const [error, setError] = useState('');
  const [status, setStatus]= useState(false);
  const [bukus, setBukus] = useState([]);

  useEffect(() => {
    const cekStatus = async function () {
      try {
        const Token = await AsyncStorage.getItem('token');
        const cek = await axios.post(`${Link}/api/buku/cekStatus`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setStatus(cek.data.message);
        setBukus(cek.data.data);
      } catch (Err) {
        console.log(Err);
      } finally {
      } 
      console.log(dataBukus);
    }

    cekStatus();
  }, [dataBukus])

  const pinjams = (data) => {

    const maxBuku = false;
    var adaBuku = false;
    
    dataBukus.find((e,i) => {
      if (e.bukuId == data.bukuId) {
        setError('Buku tersebut sudah di pinjam');
        adaBuku = true;
        return e.bukuId == data.bukuId;
      }  
    });


    if ( dataBukus.length > 3 ) {
      setError('Batas buku yang di pinjam 3');
      maxBuku = true;
    }

    if (! adaBuku || maxBuku ) {
      dispatch(store({result: data}));
    }

    setTimeout(() => {
      setError('');
    }, 1500);

    console.log(dataBukus);
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
          <ScrollView className="form space-y-2">
          
        
          {dataBukus.length == 0 && status == false && (
            <Text className="text-center font-extrabold">Tidak ada buku yang dipinjam.</Text>
          )}

          {dataBukus.length > 0 &&  status == false && dataBukus.map((e, i) => (
            <View className="flex-row rounded-xl mb-4" key={i} style={{}}> 
              <View className="w-1/4 bg-white">
                <Image source={`${Link}/api/buku/${e.foto}`} className="h-24 w-full" />
              </View>
              <View className="w-3/4 px-2 bg-white py-0">
                <Text className="font-semibold text-base tracking-wide">{e.judul}</Text>
                <Text className="tracking-wide text-xs">Penulis : {e.penulis}</Text>
                <View className="flex-row justify-end mt-7 w-full">
                  <TouchableOpacity className="border-amber-400 border-2 py-1 px-5 rounded mx-2" 
                    onPress={(element) => navigation.navigate('DetailBuku', {bukuId : e.bukuId})}
                  >
                    <Text className="text-amber-300 font-extrabold">Lihat</Text>
                  </TouchableOpacity>

                  <TouchableOpacity className="border-red-400 border-2 py-1 px-5 rounded mx-2" 
                    onPress={(element) => dispatch( hapus({result: i}) ) }
                  >
                    <Text className="text-red-300 font-extrabold">Hapus</Text>
                  </TouchableOpacity>



                </View>
              </View>
            </View>
          ))}

          {status == true && bukus.map((e, i) => (
            <View className="flex-row rounded-xl mb-4" key={i} style={{}}> 
              <View className="w-1/4 bg-white">
                <Image source={`${Link}/api/buku/${e.buku.foto}`} className="h-24 w-full" />
              </View>
              <View className="w-3/4 px-2 bg-white py-0">
                <Text className="font-semibold text-base tracking-wide">{e.buku.judul}</Text>
                <Text className="tracking-wide text-xs">Penulis : {e.buku.penulis}</Text>
                <View className="flex-row justify-end mt-7 w-full">
                  <TouchableOpacity className="border-amber-400 border-2 py-1 px-5 rounded mx-2" 
                    onPress={(element) => navigation.navigate('DetailBuku', {bukuId : e.buku.bukuId})}
                  >
                    <Text className="text-amber-300 font-extrabold">Lihat</Text>
                  </TouchableOpacity>

                </View>
              </View>
            </View>
          ))}

          </ScrollView>

      </View>

      { status == true &&
      <View className="flex-row bg-red-200 justify-center pb-6 px-4 py-2">
          <TouchableOpacity className='flex-row items-center'>
            <AntDesign name="warning" className="" size={36} color="red" />
            <Text className="text-sm text-center w-3/4 text-red-600  font-bold"> Anda sedang meminjam buku </Text>
          </TouchableOpacity>
      </View>
      }

      { dataBukus.length > 0 && status == false &&
      <View className="flex-row bg-slate-200 justify-center pb-6 px-4 py-2">
          <TouchableOpacity className='flex-row items-center' onPress={() => navigation.replace('ScanQr')}>
            <AntDesign name="scan1" className="" size={36} color="green" />
            <Text className="text-base text-center w-3/4 text-stone-950 font-bold"> Pinjam Sekarang </Text>
          </TouchableOpacity>
      </View>
    }

    </View>

  )
}
