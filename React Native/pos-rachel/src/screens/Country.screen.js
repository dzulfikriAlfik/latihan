import React, { Fragment, useState, useEffect } from "react"
import { ActivityIndicator, Dimensions, TouchableHighlight, SafeAreaView, Text, TextInput, View } from "react-native"
import TopBar from "../components/organisms/TopBar.organism"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { SearchIcon } from "react-native-heroicons/solid"
import ListCountry from "../components/organisms/ListCountry.organism"
import ButtonSecondaryBordered from "../components/molecules/ButtonSecondaryBordered.molecule"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import { connect } from "react-redux"

const Country = ({ navigation, country, changeCountry }) => {
    const [keyword, setKeyword] = useState("")
    const [isLoading, setIsLoading] = useState(true)
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
        const timeout = setTimeout(() => {
            setIsLoading((value) => !value)
            clearTimeout(timeout)
        }, 2000);
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ Tailwind`w-full min-h-full flex flex-col bg-white` }>
                    <TopBar navigation={ navigation } text={ "Pilih Negara" }/>
                    <View style={ Tailwind`w-full flex flex-col ${ handleResponsive(["px-6", "px-28"]) } py-6` }>
                        <Text style={ Tailwind`text-xs text-accent--black tracking-wide opacity-80` }>
                            Kamu tidak bisa mengubah pilihan negaramu setelah proses verifikasi selesai.
                        </Text>
                        <View style={ Tailwind`w-full px-4 py-3 rounded-md bg-gray-100 flex flex-row items-center mt-5 mb-1` }>
                            <SearchIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                            <TextInput
                                scrollEnabled={ false }
                                placeholder={ "Cari Negara" }
                                style={ Tailwind`p-0 text-sm text-accent--black flex-grow ml-4 tracking-wide` }
                                value={ keyword }
                                onChangeText={ (value) => setKeyword(() => value) }
                            />
                        </View>
                        <ListCountry/>
                    </View>
                </View>
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
                {
                    country ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center px-6`, { height: Dimensions.get("screen").height }] }>
                        <View style={ Tailwind`${ handleResponsive(["w-full", "w-96"]) } rounded-xl bg-white p-5 flex flex-col items-center` }>
                            <Text style={ Tailwind`font-bold text-lg text-accent--black` }>
                                Konfirmasi
                            </Text>
                            <Text style={ Tailwind`text-xs text-accent--black tracking-wide opacity-80 text-center mt-5 leading-relaxed` }>
                                Kamu tidak bisa mengubah pilihan negaramu setelah proses verifikasi selesai.
                            </Text>
                            <Text style={ Tailwind`text-xs text-accent--black tracking-wide opacity-80 text-center mt-2 leading-relaxed` }>
                                Kamu yaking memilih { country.name } sebagai negara pilihanmu?
                            </Text>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-8` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-24 mr-2 rounded-lg` } onPress={ () => changeCountry(null) }>
                                    <ButtonSecondaryBordered text={ "Kembali" }/>
                                </TouchableHighlight>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1 rounded-lg` } onPress={ () => {
                                    navigation.push("Register", { country })
                                    changeCountry(null)
                                } }>
                                    <ButtonPrimary text="Lanjutkan"/>
                                </TouchableHighlight>
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
        country : state.country
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCountry : (value) => dispatch({type: 'CHANGE_COUNTRY', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Country)