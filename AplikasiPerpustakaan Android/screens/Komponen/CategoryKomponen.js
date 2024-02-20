import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState, useEffect } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../../theme'
import { useNavigation } from '@react-navigation/native'
import { StatusBar } from 'expo-status-bar';
import Animated, { FadeInDown } from 'react-native-reanimated';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import {Link} from '../../controllers/Link';

export default function Kategori ({active,setActive}) {
  const [kategori, setKategori] = useState([]);

  useEffect(() => {
        async function loadKategori () {
          try {
            const Token = await AsyncStorage.getItem('token');
            const kategoriAsync = await axios.post(`${Link}/api/buku/kategori`, {}, {
              headers: {
                'Authorization': `Bearer ${Token}`
              }
            });
            setKategori(kategoriAsync.data.message);
            setActive(kategoriAsync.data.message[0].namaKategori);
          } catch (Err) {
          }
        }

        loadKategori();

      }, [])

  return (
  <Animated.View entering={FadeInDown.duration(500).springify()}>
      <ScrollView
        horizontal
        showsHorizontalScrollIndicator={false}
        className=""
        contentContainerStyle={{paddingHorizontal: 0}}
      >
      { kategori.map((e,i) => (
        <TouchableOpacity key={i} className={`${(e.namaKategori == active)? 'border-b-2 border-green-500': ''} px-6 py-1`} onPress={element => setActive(`${e.namaKategori}`)}>
          <Text className={`text-base font-semibold ${(e.namaKategori == active)? 'text-green-500': 'text-black'}`}>{e.namaKategori}</Text>
        </TouchableOpacity>
      ))}
      </ScrollView>
    </Animated.View>
  )
}