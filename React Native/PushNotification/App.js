// import AsyncStorage from '@react-native-async-storage/async-storage';
import messaging from '@react-native-firebase/messaging';
import React, {useEffect} from 'react';
import {
  Button,
  SafeAreaView,
  ScrollView,
  StatusBar,
  StyleSheet,
  View,
} from 'react-native';

import {Colors} from 'react-native/Libraries/NewAppScreen';
import {GetFCMToken} from './src/utils/pushNotifHelper';
import notifee from '@notifee/react-native';

function App() {
  useEffect(() => {
    console.log('fcmToken : ', GetFCMToken());

    const unsubscribe = messaging().onMessage(async remoteMessage => {
      const notification = remoteMessage.notification;
      const title = notification.title;
      const body = notification.body;

      onDisplayNotification(title, body);
    });

    return unsubscribe;
  }, []);

  async function onDisplayNotification(title, body) {
    try {
      // Create a channel (required for Android)
      const channelId = await notifee.createChannel({
        id: 'default',
        name: 'Default Channel',
      });
      // Display a notification
      await notifee.displayNotification({
        title: title,
        body: body,
        android: {
          channelId,
          smallIcon: 'ic_launcher', // optional, defaults to 'ic_launcher'.
          // pressAction is needed if you want the notification to open the app when pressed
          pressAction: {
            id: 'default',
          },
        },
      });
    } catch (error) {
      console.log(error);
    }
  }

  return (
    <SafeAreaView style={{backgroundColor: Colors.lighter}}>
      <StatusBar barStyle="light-content" backgroundColor={Colors.lighter} />
      <ScrollView contentInsetAdjustmentBehavior="automatic">
        <View style={style.button}>
          <Button
            title="Display Notification"
            onPress={() => onDisplayNotification()}
          />
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const style = StyleSheet.create({
  button: {
    flex: 1,
    marginTop: '50%',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default App;
