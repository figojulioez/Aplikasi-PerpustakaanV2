import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState, useEffect} from 'react'
import { themeColors } from '../theme'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid';
import { useNavigation } from '@react-navigation/native';
import { StatusBar } from 'expo-status-bar';
import AuthC from '../controllers/AuthC';
import {useSelector} from 'react-redux';
import AsyncStorage from '@react-native-async-storage/async-storage';


import Error from './Komponen/Error';

// subscribe for more videos like this :)
export default function SignUpScreen() {
    const navigation = useNavigation();
    const dataUser = useSelector(state => state.user);
    const [username, setUsername] = useState(dataUser[0].username);
    const [email, setEmail] = useState(dataUser[0].email);
    const [namaLengkap, setNamaLengkap] = useState(dataUser[0].namaLengkap);
    const [alamat, setAlamat] = useState(dataUser[0].alamat);
    const [password, setPassword] = useState('');
    const [konfirmasiPassword, setKonfirmasiPassword] = useState('');


    const [errorUsername, setErrorUsername] = useState('');
    const [errorEmail, setErrorEmail] = useState('');
    const [errorNamaLengkap, setErrorNamaLengkap] = useState('');
    const [errorAlamat, setErrorAlamat] = useState('');
    const [errorPassword, setErrorPassword] = useState('');
    const [errorKonfirmasiPassword, setErrorKonfirmasiPassword] = useState('');


    useEffect(() => {
    }, []);


    const {ganti} = AuthC();


  return (
    <View className="flex-1 bg-white" style={{backgroundColor: themeColors.bg}}>
      <StatusBar hidden={true} />
      <SafeAreaView  className="flex mt-2">
        <View className="flex-row justify-start">
          <TouchableOpacity onPress={()=> navigation.goBack()} 
          className="bg-yellow-400 p-2 rounded-xl ml-2">
                <ArrowLeftIcon size="20" color="black" />
            </TouchableOpacity>
        </View>
        <View className="flex-row justify-center">
            <Image source={require('../assets/images/signup.png')} 
                style={{width: 165, height: 110}} />
        </View>
      </SafeAreaView>
      <View className="flex-1 bg-white px-8 pt-8"
        style={{borderTopLeftRadius: 50, borderTopRightRadius: 50}}
      >
        <ScrollView className="form space-y-2">
        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Username</Text>
            <TextInput
                className={`p-2 ${(errorUsername)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                value={username}
                onChangeText={(e) => setUsername(e)}
            />
            <Error error={errorUsername} />
        </View>   

        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Email</Text>
            <TextInput
                className={`p-2 ${(errorEmail)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                value={email}
                onChangeText={(e) => setEmail(e)}

            />
            <Error error={errorEmail} />
        </View>

        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Nama Lengkap</Text>
            <TextInput
                className={`p-2 ${(errorNamaLengkap)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                value={namaLengkap}
                onChangeText={(e) => setNamaLengkap(e)}
            />
            <Error error={errorNamaLengkap} />
        </View>

        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Alamat</Text>
            <TextInput
                className={`p-2 ${(errorAlamat)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                value={alamat}
                multiline={true}
                onChangeText={(e) => setAlamat(e)}
            />
            <Error error={errorAlamat} />
        </View>

        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Password</Text>
            <TextInput
                className={`p-2 ${(errorPassword)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                secureTextEntry
                value={password}
                onChangeText={(e) => setPassword(e)}
            />
            <Error error={errorPassword} />
        </View>

        <View className="mb-3">
            <Text className="text-gray-700 ml-4">Konfirmasi Password</Text>
            <TextInput
                className={`p-2 ${(errorKonfirmasiPassword)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                secureTextEntry
                value={konfirmasiPassword}
                onChangeText={(e) => setKonfirmasiPassword(e)}
            />
            <Error error={errorKonfirmasiPassword} />
        </View>

            <TouchableOpacity
                className="py-3 rounded-xl"
                 style={{backgroundColor: themeColors.input}}
                 onPress={() => ganti(username, email, namaLengkap, alamat, password, konfirmasiPassword, setErrorUsername, setErrorEmail, setErrorNamaLengkap, setErrorAlamat, setErrorPassword, setErrorKonfirmasiPassword, navigation )}
            >
                <Text className="font-xl font-bold text-center text-slate-50">
                    Ubah Akun
                </Text>
            </TouchableOpacity>
        </ScrollView>
      </View>
    </View>
  )
}
