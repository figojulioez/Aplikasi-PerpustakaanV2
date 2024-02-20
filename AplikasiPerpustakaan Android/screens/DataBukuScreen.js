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
  const [buku, setBuku] = useState('');
  const [active, setActive] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const [dataBuku, setDataBuku] = useState([]);
  const dispatch = useDispatch()
  const dataBukus = useSelector(state => state.buku.result);
  const [maxData, setMaxData] = useState([]);
  const [error, setError] = useState('');
  const [status, setStatus] = useState(false);

  useEffect(() => {
    const fetchBuku = async function () {
      try {
        setIsLoading(true);
        const Token = await AsyncStorage.getItem('token');
        const DataBuku = await axios.post(`${Link}/api/buku/kategori/${active}`, {buku}, {headers: {'Authorization' : `Bearer ${Token}`}});

        setDataBuku(DataBuku.data.message);

      } catch (Err) {
      } finally {
        setIsLoading(false);
      } 
    }

    const cekStatus = async function () {
      try {
        const Token = await AsyncStorage.getItem('token');
        const cek = await axios.post(`${Link}/api/buku/cekStatus`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setStatus(cek.data.message);

      } catch (Err) {
        console.log(Err);
      } finally {
      } 
    }

    cekStatus();

    fetchBuku()


  }, [active, buku])

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
          <TextInput 
              className="w-9/12 px-2 ml-3 bg-gray-100 text-gray-700"
              style={{borderRadius: 5}}
              placeholder="Pencarian Buku ..."
              value={buku} 
              onChangeText={(e) => setBuku(e)}
              inputMode="search"
            />
        </View>

      </SafeAreaView>
      <CategoryKomponen active={active} setActive={setActive} />      


      <View 
        style={{}} 
        className="flex-1 bg-white px-3 pt-5">

        { status == true && 
      <View className=" bg-red-200 pb-6 px-3 py-2 mb-2">
        <Text className="text-center text-red-700 font-bold text-base">Anda sedang meminjam buku</Text>
      </View>      
        }

      { error && status == false &&
      <View className=" bg-red-200 pb-6 px-3 py-2 mb-2">
        <Text className="text-center text-red-700 font-bold text-base">{error} !!!</Text>
      </View>      
      }
          <ScrollView className="form space-y-2">
          
          {isLoading && <ActivityIndicator animating={isLoading} />}
        
          {!isLoading && dataBuku.length == 0 && (
            <Text className="text-center font-extrabold">Tidak ada data yang ditemukan.</Text>
          )}

          {!isLoading && dataBuku.length !== 0 && dataBuku.map((e, i) => (
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

                  { status == false && 
                  <TouchableOpacity className="border-emerald-400 border-2 py-1 px-5 rounded" onPress={element => pinjams(e)}>
                    <Text className="text-emerald-300">Pinjam</Text>
                  </TouchableOpacity>
                  }

                </View>
              </View>
            </View>
          ))}

          </ScrollView>

      </View>

      { status == true &&
      <View className="flex-row bg-red-200 justify-center pb-6 px-4 py-2">
          <TouchableOpacity className='flex-row items-center' onPress={() => navigation.replace('PinjamBuku')}>
            <AntDesign name="warning" className="" size={36} color="red" />
            <Text className="text-sm text-center w-3/4 text-red-600  font-bold"> Anda sedang meminjam buku </Text>
          </TouchableOpacity>
      </View>
      }

      { dataBukus.length > 0 && status == false &&
      <View className="flex-row bg-slate-200 justify-center pb-6 px-3 py-2">
          <TouchableOpacity className='flex-row items-center' onPress={() => { navigation.replace('PinjamBuku') }}>
            <FontAwesome5 name="shopping-cart" className="" size={36} color="green" />
            <Text className="text-base text-center text-stone-950 font-bold px-5"> Total buku yang di pinjam : {dataBukus.length} </Text>
          </TouchableOpacity>
      </View>
    }

    </View>

  )
}
