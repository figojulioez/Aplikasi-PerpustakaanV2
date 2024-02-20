import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState, useEffect} from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import Ionicons from '@expo/vector-icons/Ionicons';
import { StatusBar } from 'expo-status-bar';
import {useSelector} from 'react-redux';

export default function LoginScreen() {
  const navigation = useNavigation();
  const dataUser = useSelector(state => state.user);

  useEffect(() => {
  }, [])

  return (
    <View className="flex-1 bg-white" style={{backgroundColor: themeColors.bg}}>
    <StatusBar hidden={true} />

      <SafeAreaView  className="flex mt-2">
        <View className="flex-row justify-end">
          <TouchableOpacity onPress={()=> navigation.navigate('Logout')} 
          className="p-2 rounded-tr-2xl rounded-bl-2xl ml-4">
          <Ionicons name="log-out" size={32} color="white" />
          </TouchableOpacity>
        </View>
        <View  className="flex-col  pt-3 px-3 mx-6 pb-12">
          <Text className="text-slate-50 text-2xl font-semibold antialiased">Dashboard</Text>
          <Text className="text-slate-50 text-sm font-semibold antialiased">Selamat Datang, {dataUser[0].namaLengkap}</Text>
        </View>
        
        
      </SafeAreaView>
      <View 
        style={{borderTopLeftRadius: 50, borderTopRightRadius: 50, backgroundColor: '#ECECEC'}} 
        className="flex-1 bg-white px-8 pt-8">
          <ScrollView className="form flex-col space-y-2 pt-8 ">
            <View className="justify-between px-2 flex-row py-4">
              <TouchableOpacity onPress={()=> navigation.navigate('DataBuku')} 
                className="p-2 bg-white" style={{borderRadius: 20}}>
                 <Image
                  source={require('../assets/icons/buku.png')}
                  className="w-28 h-28"
                />           
                <Text className="text-center text-sm mb-2 font-semibold">Data Buku</Text>     
              </TouchableOpacity>

              <TouchableOpacity onPress={()=> navigation.navigate('KoleksiPribadi')} 
                className="p-2 bg-white" style={{borderRadius: 20}}>
                 <Image
                  source={require('../assets/icons/koleksiPribadi.png')}
                  className="w-28 h-28"
                />                
                <Text className="text-center text-sm mb-2 font-semibold">Koleksi Pribadi</Text>     
              </TouchableOpacity>
            </View>

            <View className="justify-between px-2 flex-row my-4">
              <TouchableOpacity onPress={()=> navigation.navigate('PinjamBuku')} 
                className="p-2 bg-white" style={{borderRadius: 20}}>
                 <Image
                  source={require('../assets/icons/pinjam.png')}
                  className="w-28 h-28"
                />           
                <Text className="text-center text-sm mb-2 font-semibold">Pinjam Buku</Text>     
              </TouchableOpacity>

              <TouchableOpacity onPress={()=> navigation.navigate('KembalikanBuku')} 
                className="p-2 bg-white" style={{borderRadius: 20}}>
                 <Image
                  source={require('../assets/icons/kembali.png')}
                  className="w-28 h-28"
                />                
                <Text className="text-center text-sm mb-2 font-semibold">Kembalikan Buku</Text>     
              </TouchableOpacity>
            </View>

            <View className="justify-between mb-12 px-2 flex-row my-4">
              <TouchableOpacity onPress={()=> navigation.navigate('Akun')} 
                className="p-2 bg-white w-full" style={{borderRadius: 20}}>
                 <Image
                  source={require('../assets/icons/akun.jpg')}
                  className="w-28 h-28 m-auto"
                />           
                <Text className="text-center text-sm mb-2 font-semibold">Akun anda</Text>     
              </TouchableOpacity>
            </View>

            <View className="h-12"></View>

          </ScrollView>
      </View>
    </View>
    
  )
}