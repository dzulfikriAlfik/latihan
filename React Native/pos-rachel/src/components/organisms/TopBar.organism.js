import React, { Fragment } from "react"
import { View, Text, TouchableHighlight } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { QuestionMarkCircleIcon } from "react-native-heroicons/outline"
import {  ArrowLeftIcon } from "react-native-heroicons/solid"

const TopBar = ({ navigation, text = null }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-full flex flex-row items-center justify-between bg-white px-6 pb-6 pt-10` }>
                <View style={ Tailwind`flex flex-row items-center` }>
                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => navigation.goBack() }>
                        <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                    </TouchableHighlight>
                    {
                        text &&
                        <Text style={ Tailwind`font-rubik-semibold text-accent--black ml-4 text-base` }>
                            { text }
                        </Text>
                    }
                </View>
                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => console.log("Tes") }>
                    <View style={ Tailwind`flex flex-row items-center p-2 rounded-full bg-transparent border border-gray-200` }>
                        <Text style={ [Tailwind`font-rubik-medium text-accent--black mr-1 ml-1 text-sm`, { transform: [{ translateY: -1 }] }] }>
                            Bantuan
                        </Text>
                        <QuestionMarkCircleIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                    </View>
                </TouchableHighlight>
            </View>
        </Fragment>
    )
}

export default TopBar