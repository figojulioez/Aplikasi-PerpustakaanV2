import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState} from 'react'
import { themeColors } from '../theme'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid';
import { useNavigation } from '@react-navigation/native';
import { StatusBar } from 'expo-status-bar';
import AuthC from '../controllers/AuthC';

import Error from './Komponen/Error';

// subscribe for more videos like this :)
export default function SignUpScreen() {
    const navigation = useNavigation();
    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [namaLengkap, setNamaLengkap] = useState('');
    const [alamat, setAlamat] = useState('');
    const [password, setPassword] = useState('');

    const [errorUsername, setErrorUsername] = useState('');
    const [errorEmail, setErrorEmail] = useState('');
    const [errorNamaLengkap, setErrorNamaLengkap] = useState('');
    const [errorAlamat, setErrorAlamat] = useState('');
    const [errorPassword, setErrorPassword] = useState('');

    const {create} = AuthC();


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

            <TouchableOpacity
                className="py-3 rounded-xl"
                 style={{backgroundColor: themeColors.input}}
                 onPress={() => create(username, email, namaLengkap, alamat, password, setErrorUsername, setErrorEmail, setErrorNamaLengkap, setErrorAlamat, setErrorPassword, navigation )}
            >
                <Text className="font-xl font-bold text-center text-slate-50">
                    Buat Akun
                </Text>
            </TouchableOpacity>
        </ScrollView>
        <View className="flex-row justify-center mt-7 mb-2">
            <Text className="text-gray-500 font-semibold">Sudah punya akun?</Text>
            <TouchableOpacity onPress={()=> navigation.navigate('Login')}>
                <Text className="font-semibold" style={{color: themeColors.input}}> Masuk</Text>
            </TouchableOpacity>
        </View>
      </View>
    </View>
  )
}
