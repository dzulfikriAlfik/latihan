import React, { Fragment, useState, useEffect } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, TextInput, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon } from "react-native-heroicons/solid"
import { CogIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import Drawer from "../components/organisms/Drawer.organism"

const LogCash = ({ changeDrawerStatus, navigation }) => {
    const [height, setHeight] = useState(0)
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
        changeDrawerStatus(false)
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

    return (
        <Fragment>
            <SafeAreaView>
                <Drawer/>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6 pb-6`, { height }] }>
                    <ScrollView>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`"rounded-md"` } onPress={ () => changeDrawerStatus(true) }>
                                    <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Kelola Kas
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <View style={ Tailwind`${ handleResponsive(["w-40 ml-6","w-80 ml-5"]) } px-3 py-2 rounded-md bg-gray-100 flex flex-row items-center border border-primary--red` }>
                                    <SearchIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                    <TextInput
                                        scrollEnabled={ false }
                                        placeholder={ "Cari Kas" }
                                        style={ Tailwind`p-0 text-sm text-primary--red flex-grow ml-3 tracking-wide font-rubik-regular` }
                                        placeholderTextColor={ "#F2414180" }
                                    />
                                </View>
                                <CogIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70 ml-5` }/>
                                <Image
                                    source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col items-center justify-between p-6 bg-white rounded-2xl mt-6` }>
                            <View style={ Tailwind`flex flex-col items-center mt-20 mb-30` }>
                                <Image
                                    source={ require("../assets/ilustrations/box.png") }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-50 h-50` }
                                />
                                <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                    Belum Ada Pencatatan Kas
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                    Silahkan mulai melakukan pencatatan kas dengan melalui "Buka Kasir"
                                </Text>
                            </View>
                            <TouchableHighlight style={ Tailwind`w-full rounded-lg` } onPress={ () => navigation.push("AddProduct") }>
                                <ButtonPrimary text={ "Buka Kasir" }/>
                            </TouchableHighlight>
                        </View>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
    }
}

export default connect(null, mapDispatchToProps)(LogCash)