import React, {Fragment, useState, useEffect} from 'react';
import {
  SafeAreaView,
  View,
  Text,
  TextInput,
  Pressable,
  Image,
  Dimensions,
  TouchableHighlight,
  ToastAndroid,
  ActivityIndicator,
} from 'react-native';
import Tailwind from '../libs/tailwind/Tailwind.lib';
import {EyeIcon, EyeOffIcon} from 'react-native-heroicons/solid';
import RNRestart from 'react-native-restart';
import ButtonPrimary from '../components/molecules/ButtonPrimary.molecule';
import AuthenticationFetching from '../libs/fetching/AuthenticationFetching.lib';
import ButtonSecondary from '../components/molecules/ButtonSecondary.molecule';

const Login = ({navigation}) => {
  const [isHide, setIsHide] = useState(true);
  const [widthScreen, setWidthScreen] = useState(0);
  const [isLoading, setIsLoading] = useState(false);
  const [form, setForm] = useState({
    email: '',
    password: '',
  });

  const handleResponsive = actions => {
    if (widthScreen > 0 && widthScreen <= 1000) {
      return actions[0];
    } else if (widthScreen > 1000) {
      return actions[1];
    } else {
      return actions[0];
    }
  };

  useEffect(() => {
    setWidthScreen(() => Dimensions.get('screen').width);

    Dimensions.addEventListener('change', () => {
      setWidthScreen(() => Dimensions.get('screen').width);
    });
  }, []);

  const submitForm = async () => {
    if (form.email && form.password) {
      setForm({email: '', password: ''});
      setIsLoading(true);

      const response = await AuthenticationFetching().login(form);

      setIsLoading(false);

      if (response.status) {
        ToastAndroid.show(response.message, 1500);

        RNRestart.Restart();
      } else {
        ToastAndroid.show(response.message, 1500);
      }
    }
  };

  return (
    <Fragment>
      <SafeAreaView>
        <View style={Tailwind`w-full max-h-full flex flex-row`}>
          <View
            style={Tailwind`w-1/2 min-h-full bg-primary--red ${handleResponsive(
              ['hidden'],
              'flex',
            )} flex-col items-center justify-center`}>
            <Image
              source={require('../assets/images/logo-white.png')}
              style={Tailwind`w-35 h-35`}
              resizeMode={'contain'}
            />
            <Text
              style={Tailwind`font-rubik-regular text-white text-lg tracking-wide mt-10`}>
              WEMART POS System
            </Text>
            <Text
              style={Tailwind`font-rubik-light text-white text-sm tracking-wide mt-2`}>
              Powered by SKIN
            </Text>
          </View>
          <View
            style={Tailwind`${handleResponsive([
              'w-full',
              'w-1/2',
            ])} min-h-full bg-white flex flex-col items-center justify-center py-6 ${handleResponsive(
              ['px-6', 'px-16'],
            )}`}>
            <Text
              style={Tailwind`font-rubik-medium text-3xl text-primary--red`}>
              Login Account
            </Text>
            <Text
              style={Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 text-center mt-2 tracking-wide leading-relaxed`}>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere
              iure excepturi qui molestias, voluptas distinctio?
            </Text>
            <TextInput
              placeholder="Email ID"
              style={Tailwind`font-rubik-regular text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent bg-gray-100 mt-10 border-l-4 border-primary--red`}
              value={form.email}
              onChangeText={email => setForm({...form, email})}
              keyboardType={'email-address'}
            />
            <View
              style={Tailwind`font-rubik-regular w-full px-5 py-4 rounded-md bg-transparent bg-gray-100 mt-3 flex flex-row items-center justify-between border-l-4 border-primary--red`}>
              <TextInput
                placeholder="Password"
                style={Tailwind`text-sm text-accent--black tracking-wide p-0 flex-grow`}
                secureTextEntry={isHide}
                value={form.password}
                onChangeText={password => setForm({...form, password})}
              />
              {isHide ? (
                <Pressable onPress={() => setIsHide(value => !value)}>
                  <EyeIcon size={22} style={Tailwind`text-accent--black`} />
                </Pressable>
              ) : (
                <Pressable onPress={() => setIsHide(value => !value)}>
                  <EyeOffIcon size={22} style={Tailwind`text-accent--black`} />
                </Pressable>
              )}
            </View>
            <View
              style={Tailwind`w-full flex flex-row items-center justify-between mt-3`}>
              <TouchableHighlight
                underlayColor={'#10101010'}
                onPress={() => navigation.push('ForgotPin')}>
                <Text
                  style={Tailwind`font-rubik-regular text-primary--red text-xs`}>
                  Forgot Password?
                </Text>
              </TouchableHighlight>
            </View>
            <TouchableHighlight
              underlayColor={'#10101010'}
              style={Tailwind`w-full mt-10 rounded-lg`}
              onPress={() => submitForm()}>
              {form.email && form.password ? (
                <ButtonPrimary text={'LOGIN'} />
              ) : (
                <ButtonSecondary text={'LOGIN'} />
              )}
            </TouchableHighlight>
          </View>
        </View>
        {isLoading ? (
          <View
            style={[
              Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`,
              {height: Dimensions.get('screen').height},
            ]}>
            <ActivityIndicator color={'#FFFFFF'} size={'large'} />
          </View>
        ) : null}
      </SafeAreaView>
    </Fragment>
  );
};

export default Login;
