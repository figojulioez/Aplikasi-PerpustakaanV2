import { View, Text } from 'react-native'
import React from 'react'
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import DashboardScreen from '../screens/DashboardScreen';
import WelcomeScreen from '../screens/WelcomeScreen';
import LoginScreen from '../screens/LoginScreen';
import SignUpScreen from '../screens/SignUpScreen';
import DataBukuScreen from '../screens/DataBukuScreen';
import DetailBukuScreen from '../screens/DetailBukuScreen';
import PinjamBukuScreen from '../screens/PinjamBukuScreen';
import ScanQrScreen from '../screens/ScanQrScreen';
import KoleksiPribadiScreen from '../screens/KoleksiPribadiScreen';
import KembalikanBukuScreen from '../screens/KembalikanBukuScreen';
import AkunScreen from '../screens/AkunScreen';
import LogoutScreen from '../screens/LogoutScreen';

import Auth from '../middleware/Auth';
import Guest from '../middleware/Guest';

const Stack = createNativeStackNavigator();


export default function AppNavigation() {

    const Dashboard = () => {
      return (
        <Auth>
          <DashboardScreen />
        </Auth>
        )
    }

    const Login = () => {
      return (
        <Guest>
          <LoginScreen />
        </Guest>
      )
    }

    const Welcome = () => {
      return (
        <Guest>
          <WelcomeScreen />
        </Guest>
      )
    }

    const SignUp = () => {
      return (
        <Guest>
          <SignUpScreen />
        </Guest>
      )
    }

    const DataBuku = () => {
      return (
        <Auth>
          <DataBukuScreen />
        </Auth>
      )
    }

    const DetailBuku = ({route}) => {
      return (
        <Auth>
          <DetailBukuScreen route={route} />
        </Auth>
      )
    }

    const PinjamBuku = ({route}) => {
      return (
        <Auth>
          <PinjamBukuScreen route={route} />
        </Auth>
      )
    }

    const ScanQr = ({route}) => {
      return (
        <Auth>
          <ScanQrScreen route={route} />
        </Auth>
      )
    }

    const KoleksiPribadi = ({route}) => {
      return (
        <Auth>
          <KoleksiPribadiScreen route={route} />
        </Auth>
      )
    }

    const KembalikanBuku = ({route}) => {
      return (
        <Auth>
          <KembalikanBukuScreen route={route} />
        </Auth>
      )
    }

    const Akun = ({route}) => {
      return (
        <Auth>
          <AkunScreen route={route} />
        </Auth>
      )
    }

    const Logout = ({route}) => {
      return (
        <Auth>
          <LogoutScreen route={route} />
        </Auth>
      )
    }


  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName='Welcome'>
        <Stack.Screen name="Dashboard" options={{headerShown: false}} component={Dashboard} />
        <Stack.Screen name="Welcome" options={{headerShown: false}} component={Welcome} />
        <Stack.Screen name="Login" options={{headerShown: false}} component={Login} />
        <Stack.Screen name="SignUp" options={{headerShown: false}} component={SignUp} />
        <Stack.Screen name="DataBuku" options={{headerShown: false}} component={DataBuku} />
        <Stack.Screen name="DetailBuku" options={{headerShown: false}} component={DetailBuku} />
        <Stack.Screen name="PinjamBuku" options={{headerShown: false}} component={PinjamBuku} />
        <Stack.Screen name="ScanQr" options={{headerShown: false}} component={ScanQr} />
        <Stack.Screen name="KoleksiPribadi" options={{headerShown: false}} component={KoleksiPribadi} />
        <Stack.Screen name="KembalikanBuku" options={{headerShown: false}} component={KembalikanBuku} />
        <Stack.Screen name="Akun" options={{headerShown: false}} component={Akun} />
        <Stack.Screen name="Logout" options={{headerShown: false}} component={Logout} />
      </Stack.Navigator>
    </NavigationContainer>
  )
}