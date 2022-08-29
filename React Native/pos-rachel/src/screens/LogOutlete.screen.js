import React, { Fragment, useState, useEffect, createContext } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, TextInput, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon, PlusIcon } from "react-native-heroicons/solid"
import { CogIcon, OfficeBuildingIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import Drawer from "../components/organisms/Drawer.organism"

const TagContext = createContext()
const { Provider } = TagContext

const LogOutlete = ({ changeDrawerStatus, navigation }) => {
    const [height, setHeight] = useState(0)
    const [tag, setTag] = useState("Kasir")
    const data = [
        {
            "name": "Pusat",
            "location": "Citaman"
        }
    ]

    useEffect(() => {
        changeDrawerStatus(false)
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <Provider value={ { tag, setTag } }>
                    <Drawer/>
                    <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                        <ScrollView showsVerticalScrollIndicator={ false }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`"rounded-md"` } onPress={ () => changeDrawerStatus(true) }>
                                        <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    </TouchableHighlight>
                                    <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                        Daftar Pegawai
                                    </Text>
                                </View>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Image
                                        source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                                        resizeMode={ "contain" }
                                        style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                    />
                                </View>
                            </View>
                            <View style={ Tailwind`w-full flex flex-col items-center justify-between p-6 bg-white rounded-2xl mt-6` }>
                                <View style={ Tailwind`w-full p-4 rounded-md bg-gray-100 flex flex-row items-center` }>
                                    <SearchIcon size={ 22 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    <TextInput
                                        scrollEnabled={ false }
                                        placeholder={ "Cari Outlete" }
                                        style={ Tailwind`p-0 text-sm text-accent--black flex-grow ml-3 tracking-wide font-rubik-regular` }
                                        placeholderTextColor={ "#b1b1b1" }
                                    />
                                    <CogIcon size={ 22 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row flex-grow mt-5` }>
                                    {
                                        React.Children.toArray(data.map(item => {
                                            return (
                                                <View style={ Tailwind`w-60 p-3 bg-primary--red--20 flex flex-row items-center rounded-md` }>
                                                    <View style={ Tailwind`w-13 h-13 rounded-md bg-primary--red flex flex-col items-center justify-center` }>
                                                        <OfficeBuildingIcon size={ 30 } style={ Tailwind`text-white` }/>
                                                    </View>
                                                    <View style={ Tailwind`flex flex-grow flex-col ml-3 overflow-hidden` }>
                                                        <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                                            { item.name }
                                                        </Text>
                                                        <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs opacity-50` }>
                                                            { item.location }
                                                        </Text>
                                                    </View>
                                                </View>
                                            )
                                        }))
                                    }
                                </View>
                            </View>
                        </ScrollView>
                    </View>
                    <TouchableHighlight onPress={ () => navigation.push("AddOutlete") } underlayColor={ "#10101010" } style={ [Tailwind`w-14 h-14 rounded-full bg-primary--red z-50 absolute flex flex-col items-center justify-center`, { transform: [{ translateX: Dimensions.get("screen").width - 90 }, { translateY: Dimensions.get("screen").height - 100 }] }] }>
                        <PlusIcon size={ 35 } color={ "#FFFFFF" }/>
                    </TouchableHighlight>
                </Provider>
            </SafeAreaView>
        </Fragment>
    )
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
    }
}

export default connect(null, mapDispatchToProps)(LogOutlete)