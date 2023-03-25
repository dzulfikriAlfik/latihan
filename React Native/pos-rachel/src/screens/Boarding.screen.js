import React, { Fragment } from "react"
import { LogBox, SafeAreaView, Text, TouchableHighlight, View, Image } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import ButtonPrimaryWhite from "../components/molecules/ButtonPrimaryWhite.molecule"

const Boarding = ({ navigation }) => {
    LogBox.ignoreAllLogs(true)

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ Tailwind`w-full min-h-full flex flex-col items-center justify-center bg-primary--red` }>
                    <Image
                        source={ require("../assets/images/logo-white.png") }
                        style={ Tailwind`w-35 h-35` }
                        resizeMode={ "contain" }
                    />
                    <Text style={ Tailwind`font-rubik-regular text-white text-lg tracking-wide mt-10` }>
                        Selamat Datang di WEMART POS System
                    </Text>
                    <Text style={ Tailwind`font-rubik-light text-white text-sm tracking-wide mt-2` }>
                        Powered by SKIN
                    </Text>
                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-72 mt-10 rounded-lg` } onPress={ () => navigation.push("Login") }>
                        <ButtonPrimaryWhite text={ "Masuk" }/>
                    </TouchableHighlight>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default Boarding