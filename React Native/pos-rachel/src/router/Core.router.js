import { NavigationContainer } from "@react-navigation/native"
import { createNativeStackNavigator } from "@react-navigation/native-stack"
import React, { Fragment } from "react"
import { StatusBar } from "react-native"
import Splash from "../screens/Splash.screen"
import Boarding from "../screens/Boarding.screen"
import Country from "../screens/Country.screen"
import Register from "../screens/Register.screen"
import Login from "../screens/Login.screen"
import ForgotPin from "../screens/ForgotPin.screen"
import LoadingHome from "../screens/LoadingHome.screen"
import { Provider } from "react-redux"
import ReduxStore from "../configs/redux/redux.config"
import Home from "../screens/Home.screen"
import Transaction from "../screens/Transaction.screen"
import AddProduct from "../screens/AddProduct.screen"
import AddStock from "../screens/AddStock.screen"
import LogProduct from "../screens/LogProduct.screen"
import LogCash from "../screens/LogCash.screen"
import Worker from "../screens/Worker.screen"
import DetailWorker from "../screens/DetailWorker.screen"
import LogOutlete from "../screens/LogOutlete.screen"
import AddWorker from "../screens/AddWorker.screen"
import AddOutlete from "../screens/AddOutlete.screen"
import LogReport from "../screens/LogReport.screen"
import Setting from "../screens/Setting.screen"
import LogTransaction from "../screens/LogTransaction.screen"
import ListTransation from "../screens/ListTransaction.screen"
import DetailTransaction from "../screens/DetailTransaction.screen"
import ScanQr from "../screens/ScanQr.screen"
import DetailReportMonthly from "../screens/DetailReportMonthly.screen"
import DetailReportDaily from "../screens/DetailReportDaily.screen"

const Stack = createNativeStackNavigator()

const Core = () => {
    return (
        <Fragment>
            <Provider store={ ReduxStore }>
                <StatusBar backgroundColor={ "#E83A1400" } networkActivityIndicatorVisible={ true } translucent={ true } hidden={ true } barStyle={ "dark-content" }/>
                <NavigationContainer>
                    <Stack.Navigator initialRouteName="Splash" screenOptions={ { headerShown: false } }>
                        <Stack.Screen name="Splash" component={ Splash }/>
                        <Stack.Screen name="Boarding" component={ Boarding }/>
                        <Stack.Screen name="Country" component={ Country }/>
                        <Stack.Screen name="Register" component={ Register }/>
                        <Stack.Screen name="Login" component={ Login }/>
                        <Stack.Screen name="ForgotPin" component={ ForgotPin }/>
                        <Stack.Screen name="LoadingHome" component={ LoadingHome }/>
                        <Stack.Screen name="Home" component={ Home }/>
                        <Stack.Screen name="Transaction" component={ Transaction }/>
                        <Stack.Screen name="AddProduct" component={ AddProduct }/>
                        <Stack.Screen name="AddStock" component={ AddStock }/>
                        <Stack.Screen name="LogProduct" component={ LogProduct }/>
                        <Stack.Screen name="LogCash" component={ LogCash }/>
                        <Stack.Screen name="Worker" component={ Worker }/>
                        <Stack.Screen name="DetailWorker" component={ DetailWorker }/>
                        <Stack.Screen name="LogOutlete" component={ LogOutlete }/>
                        <Stack.Screen name="AddWorker" component={ AddWorker }/>
                        <Stack.Screen name="AddOutlete" component={ AddOutlete }/>
                        <Stack.Screen name="LogReport" component={ LogReport }/>
                        <Stack.Screen name="Setting" component={ Setting }/>
                        <Stack.Screen name="LogTransaction" component={ LogTransaction }/>
                        <Stack.Screen name="ListTransaction" component={ ListTransation }/>
                        <Stack.Screen name="DetailTransaction" component={ DetailTransaction }/>
                        <Stack.Screen name="ScanQr" component={ ScanQr }/>
                        <Stack.Screen name="DetailReportMonthly" component={ DetailReportMonthly }/>
                        <Stack.Screen name="DetailReportDaily" component={ DetailReportDaily }/>
                    </Stack.Navigator>
                </NavigationContainer>
            </Provider>
        </Fragment>
    )
}

export default Core