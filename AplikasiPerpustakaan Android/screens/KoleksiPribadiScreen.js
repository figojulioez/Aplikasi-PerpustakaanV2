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
import {useSelector} from 'react-redux';


export default function LoginScreen() {
  const navigation = useNavigation();
  const dispatch = useDispatch()
  const [dataBukus, setDataBukus] = useState([]);
  const [maxData, setMaxData] = useState([]);
  const [error, setError] = useState('');
  const [status, setStatus]= useState(false);
  const [bukus, setBukus] = useState([]);

  useEffect(() => {
    const cekStatus = async function () {
      try {
        const Token = await AsyncStorage.getItem('token');
        const data = await axios.post(`${Link}/api/buku/koleksiPribadi`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setDataBukus(data.data.message);
      } catch (Err) {
        console.log(Err);
      } finally {
      } 
    }


    cekStatus();
  }, [dataBukus])


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
            <Text className="text-slate-50 text-2xl font-semibold antialiased text-center">Koleksi Pribadi</Text>
          </View>
        </View>

      </SafeAreaView>


      <View 
        style={{}} 
        className="flex-1 bg-white px-3 pt-5">


          {dataBukus.length == 0 && (
            <Text className="text-center font-extrabold">Tidak ada data yang ditemukan.</Text>
          )}

          <ScrollView className="form space-y-2">
          {dataBukus.length > 0 && dataBukus.map((e, i) => (
            <View className="flex-row rounded-xl mb-4" key={i} style={{}}> 
              <View className="w-1/4 bg-white">
                <Image source={`${Link}/api/buku/${e.buku.foto}`} className="h-24 w-full" />
              </View>
              <View className="w-3/4 px-2 bg-white py-0">
                <Text className="font-semibold text-base tracking-wide">{e.buku.judul}</Text>
                <Text className="tracking-wide text-xs">Penulis : {e.buku.penulis}</Text>
                <View className="flex-row justify-end mt-7 w-full">
                  <TouchableOpacity className="border-amber-400 border-2 py-1 px-5 rounded mx-2" 
                    onPress={(element) => navigation.navigate('DetailBuku', {bukuId : e.buku.bukuId, authorize: true})}
                  >
                    <Text className="text-amber-300 font-extrabold">Lihat</Text>
                  </TouchableOpacity>

                </View>
              </View>
            </View>
          ))}

          </ScrollView>

      </View>

    </View>

  )
}
