import { View, Text, TouchableOpacity, TextInput, ScrollView, ImageBackground } from 'react-native'
import React, {useState, useEffect} from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import AntDesign from '@expo/vector-icons/AntDesign';
import { StatusBar } from 'expo-status-bar';
import {useSelector} from 'react-redux';
import axios from 'axios';
import {Link} from '../controllers/Link';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { Image } from 'expo-image';

export default function LoginScreen({route}) {
  const navigation = useNavigation();
  const dataUser = useSelector(state => state.user);
  let {bukuId, authorize} = route.params;
  const [detailBuku, setDetailBuku] = useState([]);
  const [kategori, setKategori] = useState('');
  const [jumlah, setJumlah] = useState(0);
  const [ulasan, setUlasan] = useState('');
  const [a, setA] = useState(0);
  const [sudah, setSudah] = useState(false);
  const [komentar, setKomentar] = useState([]);
  const [error, setError] = useState('');

  useEffect(() => {
    const FetchDetail = async () => {
      try {
        const Token = await AsyncStorage.getItem('token');
        const Detail = await axios.post(`${Link}/api/buku/detail/${bukuId}`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setDetailBuku(Detail.data.message);
        console.log(Detail.data.message);
        setKategori(Detail.data.message.kategori.namaKategori);
      } catch (Err) {
        console.log(Err);
      }
    }

    const cek = async () => {
     try {
        const Token = await AsyncStorage.getItem('token');
        const cekDulu = await axios.post(`${Link}/api/buku/cekSudahRating`, {bukuId}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setSudah(cekDulu.data.message);
      } catch (Err) {
        console.log(Err);
      } 
    }

    const fetchKomentar = async () => {
     try {
        const Token = await AsyncStorage.getItem('token');
        const Komentars = await axios.post(`${Link}/api/buku/fetchKomentar`, {bukuId}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setKomentar(Komentars.data.message);
      } catch (Err) {
        
      } 
    } 

    fetchKomentar();
    cek();
    FetchDetail();

  }, [a])

  const kirim = async () => {
    const rating = jumlah;     
    try {
        const Token = await AsyncStorage.getItem('token');
        const Detail = await axios.post(`${Link}/api/buku/beriUlasan`, {rating, bukuId, ulasan}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setA(e => e+1);
      } catch (Err) {
        // console.log(Err);
        setError(Err.response.data.messages.ulasan);
      }
  }

  return (
    <ImageBackground source={{uri: `${Link}/api/buku/${detailBuku.foto}`}} className="flex-1 bg-white" style={{}} blurRadius={7}>
    <StatusBar hidden={true} />

      <SafeAreaView  className="flex mt-2">
        <View className="flex-row justify-start">
          <TouchableOpacity onPress={()=> navigation.goBack()} 
          className="bg-yellow-400 p-2 rounded-xl ml-2">
            <ArrowLeftIcon size="20" color="black" />
          </TouchableOpacity>
        </View>
         
        <Image source={`${Link}/api/buku/${detailBuku.foto}`} className="h-32 w-28 mx-auto mb-9" />

      </SafeAreaView>
      <View 
        style={{borderTopLeftRadius: 50, borderTopRightRadius: 50, backgroundColor: '#ECECEC'}} 
        className="flex-1 bg-white px-8 pt-8">
          <View className="border-b-2 pb-4 mt-3">
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Judul</Text>
              <Text className="w-2/4" style={{}}>: {detailBuku.judul}</Text>
            </View>
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Penulis</Text>
              <Text className="w-2/4">: {detailBuku.penulis}</Text>
            </View>
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Tahun Terbit</Text>
              <Text className="w-2/4">: {detailBuku.tahunTerbit}</Text>
            </View>
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Kategori</Text>
              <Text className="w-2/4">: {kategori}</Text>
            </View>
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Harga Denda</Text>
              <Text className="w-2/4">: Rp. {detailBuku.harga}</Text>
            </View>
            <View className="flex-row justify-between mb-2">
              <Text className="font-bold w-2/4"><Ionicons name="caret-forward-circle-outline" size={16} />  Rating</Text>
              <Text className="w-2/4">: {detailBuku.rating} dari 5</Text>
            </View>
          </View>
          <ScrollView className="form flex-col space-y-2 pt-2 ">
            <View className="mb-3">

                  { error && 
                    <View className=" bg-red-200 pb-6 px-3 py-2 mb-2">
                      <Text className="text-center text-red-700 font-bold text-base">{error} !!!</Text>
                    </View>      
                  }


            { authorize && sudah == false &&
              <>  
              <View className="p-2 flex-row justify-between">
                <TouchableOpacity onPress={eS => (jumlah != 0)? setJumlah(e => e - 1):setJumlah(e => e) }>
                  <AntDesign name="minussquare" size={40} />
                </TouchableOpacity>

                <Text className="text-2xl font-bold">{jumlah}</Text>
                
                <TouchableOpacity onPress={eS => (jumlah != 5)? setJumlah(e => e + 1):setJumlah(e => e) }>
                  <AntDesign name="plussquare" size={40} />
                </TouchableOpacity>
              </View>
              <TextInput
                  className={`p-2 ${(false)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                  multiline={true}
                  placeholder="Beri Ulasan ..."
                  value={ulasan}
                  onChangeText = {e => setUlasan(e)}
              />
              <TouchableOpacity className="w-full p-2 bg-green-600 mt-2 rounded-2xl" onPress={kirim}>
                <Text className="text-base text-center text-slate-50 font-bold">Kirim rating dan ulasan</Text>
              </TouchableOpacity>
              </>
            }

            {komentar.length > 0 && komentar.map((e,i) => (
            <View className="form mt-5" key={i}>
              <View className="bg-lime-600 p-2 rounded-t-lg flex-row justify-between">
                <Text className="font-semibold text-white">{ e.user.email }</Text>
                <Text className="text-xs w-1/4 text-white">{new Date(e.created_at).getFullYear()}-{new Date(e.created_at).getMonth()+1}-{new Date(e.created_at).getDate()} {new Date(e.created_at).getHours()}:{new Date(e.created_at).getMinutes()}</Text>
              </View>
              <View className="bg-white p-2">
              <Text className="text-justify">{e.ulasan}</Text>
              </View>
            </View>
            ))}

          {komentar.length == 0 && (
            <Text className="text-center mt-5 font-extrabold">Tidak ada komentar yang ditemukan.</Text>
          )}


        </View>
          </ScrollView>
      </View>
    </ImageBackground>
    
  )
}
