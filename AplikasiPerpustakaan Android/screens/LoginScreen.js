import { View, Text, TouchableOpacity, Image, TextInput, ScrollView } from 'react-native'
import React, {useState} from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import {ArrowLeftIcon} from 'react-native-heroicons/solid'
import { themeColors } from '../theme'
import { useNavigation } from '@react-navigation/native'
import { StatusBar } from 'expo-status-bar';
import AuthC from '../controllers/AuthC';

import Error from './Komponen/Error';

export default function LoginScreen() {
  const navigation = useNavigation();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [errorEmail, setErrorEmail] = useState('');
  const [errorPassword, setErrorPassword] = useState('');

  const {login} = AuthC();



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
        <View  className="flex-row justify-center">
          <Image source={require('../assets/images/login.png')} 
          style={{width: 200, height: 200}} />
        </View>
        
        
      </SafeAreaView>
      <View 
        style={{borderTopLeftRadius: 50, borderTopRightRadius: 50}} 
        className="flex-1 bg-white px-8 pt-8">
          <ScrollView className="form space-y-2">
            <View className="mb-3">
              <Text className="text-gray-700 ml-4">Email</Text>
              <TextInput 
                className={`p-4 ${(errorEmail)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                placeholder="Email"
                value={email} 
                onChangeText={(e) => setEmail(e)}
              />
              <Error error={errorEmail} />
            </View>

            <View>
              <Text className="text-gray-700 ml-4">Password</Text>
              <TextInput 
                className={`p-4 ${(errorPassword)? 'bg-red-300':'bg-gray-100'} text-gray-700 rounded-2xl`}
                secureTextEntry
                placeholder="Password"
                value={password} 
                onChangeText={(e) => setPassword(e)}
              />
              <Error error={errorPassword} />
            </View>

            <TouchableOpacity 
              style={{backgroundColor: themeColors.input}}
              className="py-3 bg-yellow-400 rounded-xl" onPress={() => {login(email, password, setErrorEmail, setErrorPassword, navigation)}}>
                <Text 
                    className="text-xl font-bold text-center text-slate-50"
                >
                        Masuk
                </Text>
             </TouchableOpacity>
            
          </ScrollView>
          <View className="flex-row justify-center mt-2 mb-2">
              <Text className="text-gray-500 font-semibold">
                  Belum punya akun?
              </Text>
              <TouchableOpacity onPress={()=> navigation.navigate('SignUp')}>
                  <Text className="font-semibold" style={{color: themeColors.input}}> Buat akun</Text>
              </TouchableOpacity>
          </View>
          
      </View>
    </View>
    
  )
}