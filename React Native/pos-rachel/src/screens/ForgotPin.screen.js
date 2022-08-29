import React, { Fragment, useState, useEffect } from "react"
import { SafeAreaView, View, Text, TextInput, Pressable, Image, Dimensions } from "react-native"
import TopBar from "../components/organisms/TopBar.organism"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ChevronDownIcon, XIcon ,SearchIcon } from "react-native-heroicons/solid"
import ListCountryPhone from "../components/organisms/ListCountryPhone.organism"
import { connect } from "react-redux"

const ForgotPin = ({ navigation, countryPhone }) => {
    const [height, setHeight] = useState(0)
    const [isShow, setIsShow] = useState(false)
    const [widthScreen, setWidthScreen] = useState(0)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])
    
    useEffect(() => {
        setIsShow(() => false)
    }, [countryPhone])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ Tailwind`w-full flex flex-col bg-white min-h-full` }>
                    <TopBar navigation={ navigation } text={ "Lupa Pin" }/>
                    <View style={ Tailwind`w-full ${ handleResponsive(["px-6", "px-28"]) } py-6 flex flex-col` }>
                        <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black tracking-wide opacity-80 mb-2` }>
                            Silahkan masukan No. Handphone yang terdaftar di akun kamu.
                        </Text>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                            <Pressable onPress={ () => setIsShow((value) => !value) }>
                                <View style={ Tailwind`px-4 py-4 pr-3 rounded-md bg-transparent border border-gray-200 mt-3 flex flex-row items-center justify-between mr-2` }>
                                    <Image
                                        source={ countryPhone.flag }
                                        style={ Tailwind`w-10 h-7 rounded-sm border-2 border-gray-200` }
                                        resizeMode={ "contain" }
                                    />
                                    <ChevronDownIcon size={ 22 } style={ Tailwind`text-accent--black ml-1` }/>
                                </View>
                            </Pressable>
                            <TextInput
                                placeholder="No.Handphone"
                                style={ Tailwind`font-rubik-regular text-sm text-accent--black tracking-wide flex-grow px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                            />
                        </View>
                        <View style={ Tailwind`w-full mt-10` }>
                            <ButtonSecondary text={ "Lanjut" }/>
                        </View>
                    </View>
                </View>
                {
                    isShow ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ [Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center`, { height: height - 200 }] }>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-bold text-lg text-accent--black` }>
                                        Kode Panggilan
                                    </Text>
                                    <Pressable onPress={ () => setIsShow((value) => !value) }>
                                        <XIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    </Pressable>
                                </View>
                                <View style={ Tailwind`w-full px-4 py-3 rounded-md bg-gray-100 flex flex-row items-center mt-5 mb-1` }>
                                    <SearchIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    <TextInput
                                        scrollEnabled={ false }
                                        placeholder={ "Cari Negara" }
                                        style={ Tailwind`p-0 text-sm text-accent--black flex-grow ml-4 tracking-wide` }
                                    />
                                </View>
                                <View style={ [Tailwind`w-full`, { height: height - 345 }] }>
                                    <ListCountryPhone/>
                                </View>
                            </View>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        countryPhone : state.countryPhone
    }
}

export default connect(mapStateToProps, null)(ForgotPin)