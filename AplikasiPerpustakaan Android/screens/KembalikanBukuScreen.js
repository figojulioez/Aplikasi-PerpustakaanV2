import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState, useEffect} from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import { StatusBar } from 'expo-status-bar';
import {useSelector} from 'react-redux';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import {Link} from '../controllers/Link';

export default function LoginScreen() {
  const navigation = useNavigation();
  const dataUser = useSelector(state => state.user);
  const [data, setData] = useState([]);
  const [total, setTotal] = useState(0);

  useEffect(() => {
    const fetchPengembalian = async () => {
     try {
        const Token = await AsyncStorage.getItem('token');
        const Pengembalians = await axios.post(`${Link}/api/buku/fetchPengembalian`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setData(Pengembalians.data);
      } catch (Err) {
        console.log(Err);
      } 
    } 

    const totalDenda = async () => {
     try {
        const Token = await AsyncStorage.getItem('token');
        const denda = await axios.post(`${Link}/api/buku/totalDenda`, {}, {headers: {'Authorization' : `Bearer ${Token}`}});
        setTotal(denda.data.message);
      } catch (Err) {
        console.log(Err);
      } 
    } 

    totalDenda();
    fetchPengembalian();

  }, [])

  return (
    <View className="flex-1 bg-white" style={{backgroundColor: themeColors.bg}}>
    <StatusBar hidden={true} />

      <SafeAreaView  className="flex pt-4 pb-5">
        <View className="flex-row justify-start">
          <TouchableOpacity onPress={()=> navigation.goBack()} 
          className="bg-yellow-400 p-2 rounded-xl ml-2">
            <ArrowLeftIcon size="20" color="black" />
          </TouchableOpacity>
          <View className="w-9/12 px-2 ml-3">
            <Text className="text-slate-50 text-2xl font-semibold antialiased text-center">Pengembalian Buku</Text>
          </View>
        </View>
        <View  className="flex-col bg-cyan-200 pt-3 mt-4 justify-between flex-row rounded-xl shadow px-3 mx-6">
          <Text className="text-blue-700 text-base font-semibold antialiased">Total Denda</Text>
          <Text className="text-blue-700 text-sm text-2xl mb-5 font-semibold antialiased">Rp. {total}</Text>
        </View>
        
        
      </SafeAreaView>
      <View 
        style={{borderTopLeftRadius: 50, borderTopRightRadius: 50, backgroundColor: '#ECECEC'}} 
        className="flex-1 bg-white px-8 pt-8">
        <Text className="text-center text-base border-b-2 pb-5 font-extrabold">Histori Peminjaman Anda</Text>
          <ScrollView className="form flex-col space-y-2 pt-8 ">

          { data.length > 0 && data.map( (e, i) => (
            <View className="form mt-2" key={i}>
              <View className="bg-lime-600 p-2 rounded-t-lg flex-row justify-between">
                <Text className="font-bold text-white">Denda terlambat: Rp.{e.denda}</Text>
                <Text className="text-xs text-white font-semibold">{new Date(e.created_at).getDate()}-{new Date(e.created_at).getMonth()+1}-{new Date(e.created_at).getFullYear()}</Text>
              </View>
              <View className="bg-white p-2 rounded-b-lg">
              <Text className="text-justify">{e.judul}</Text>
              </View>
            </View> 
          ))}

          </ScrollView>
      </View>
    </View>
    
  )
}