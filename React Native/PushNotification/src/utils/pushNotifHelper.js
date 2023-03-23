import messaging from '@react-native-firebase/messaging';
import AsyncStorage from '@react-native-async-storage/async-storage';

export async function requestUserPermission() {
  const authStatus = await messaging().requestPermission();
  const enabled =
    authStatus === messaging.AuthorizationStatus.AUTHORIZED ||
    authStatus === messaging.AuthorizationStatus.PROVISIONAL;

  if (enabled) {
    console.log('Authorization status:', authStatus);
    GetFCMToken();
  }
}

export async function GetFCMToken() {
  let fcmToken = await AsyncStorage.getItem('fcmtoken');
  console.log('old token ', fcmToken);

  if (!fcmToken) {
    try {
      fcmToken = await messaging().getToken();

      console.log('fcmToken :', fcmToken);

      if (fcmToken) {
        AsyncStorage.setItem('fcmtoken ', JSON.stringify(fcmToken));
      }
    } catch (error) {
      console.log('error in fcmtoken ', error);
    }
  }
}

export const NotificationListener = () => {
  // Assume a message-notification contains a "type" property in the data payload of the screen to open

  messaging().onNotificationOpenedApp(remoteMessage => {
    console.log(
      'Notification caused app to open from background state:',
      remoteMessage.notification,
    );
  });

  // Check whether an initial notification is available
  messaging()
    .getInitialNotification()
    .then(remoteMessage => {
      if (remoteMessage) {
        console.log(
          'Notification caused app to open from quit state:',
          remoteMessage.notification,
        );
      }
    });

  messaging().onMessage(async remoteMessage => {
    console.log('Notif on state ', remoteMessage);
  });
};
