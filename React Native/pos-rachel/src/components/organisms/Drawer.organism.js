import React, { Fragment, useState, useEffect } from "react"
import { View, ScrollView, Text, Image, Dimensions, Animated, TouchableHighlight, ActivityIndicator } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { ChevronRightIcon } from "react-native-heroicons/solid"
import { CurrencyDollarIcon, TruckIcon, HomeIcon, ArchiveIcon, NewspaperIcon, ClipboardListIcon, CogIcon, SupportIcon, UsersIcon, OfficeBuildingIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import GestureRecognizer from "react-native-swipe-detect"
import ItemMenuDrawer from "../molecules/ItemMenuDrawer.molecule"
import { useNavigation } from "@react-navigation/native"

const Drawer = ({ drawerStatus, changeDrawerStatus, user }) => {
    const [height, setHeight] = useState(0)
    const translate = new Animated.Value(-400)
    const navigation = useNavigation()

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    useEffect(() => {
        if(drawerStatus) {
            openDrawer()
        }
    }, [drawerStatus])

    const openDrawer = () =>{
        setTimeout(() => {
            Animated.timing(translate, {
                toValue: 0,
                useNativeDriver: false,
                duration: 300
            }).start()
        }, 200);
    }

    const hideDrawer = () => {
        Animated.timing(translate, {
            toValue: -400,
            useNativeDriver: false,
            duration: 300
        }).start()

        setTimeout(() => {
            changeDrawerStatus(false)
        }, 500);
    }

    return (
        <Fragment>
            <GestureRecognizer
                onSwipeLeft={ () => hideDrawer() }
            >
                <View style={ [Tailwind`w-full bg-accent--black--60 absolute z-50 ${ drawerStatus ? "flex" : "hidden" }`, { height }] }>
                    <Animated.View style={ [Tailwind`w-80 bg-white py-10`, { height, transform: [{ translateX: translate }] }] }>
                        {
                            user ? 
                                <View style={ Tailwind`w-full flex flex-row items-center pb-0 border-b border-gray-200 px-6 justify-between` }>
                                    <View style={ Tailwind`flex flex-row items-center mb-5` }>
                                        <View style={ Tailwind`flex flex-col items-center` }>
                                            <Image
                                                source={ { uri: user.avatar } }
                                                resizeMode={ "contain" }
                                                style={ Tailwind`w-13 h-13 rounded-full` }
                                            />
                                        </View>
                                        <View style={ Tailwind`flex flex-col ml-5 mt-3` }>
                                            <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm -mt-2` }>
                                                { user.name }
                                            </Text>
                                            <Text style={ Tailwind`font-rubik-regular text-accent--black text-sm tracking-wide leading-relaxed opacity-80` }>
                                                Vendor
                                            </Text>
                                        </View>
                                    </View>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black opacity-50 -mt-3` }/>
                                </View> : <ActivityIndicator size={ "small" }/>
                        }
                        <ScrollView showsVerticalScrollIndicator={ false }>
                            <View style={ Tailwind`mt-3` }/>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("Home") }>
                                <ItemMenuDrawer
                                    title={ "Beranda" }
                                    icon={ <HomeIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "Home" }
                                />
                            </TouchableHighlight>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("LogReport") }>
                                <ItemMenuDrawer
                                    title={ "Laporan" }
                                    icon={ <ClipboardListIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "LogReport" }
                                />
                            </TouchableHighlight>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("LogTransaction") }>
                                <ItemMenuDrawer
                                    title={ "Riwayat Transaksi" }
                                    icon={ <NewspaperIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "LogTransaction" }
                                />
                            </TouchableHighlight>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("LogProduct") }>
                                <ItemMenuDrawer
                                    title={ "Katalog Produk" }
                                    icon={ <TruckIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "LogProduct" }
                                />
                            </TouchableHighlight>
                            {/* <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("Worker") }>
                                <ItemMenuDrawer
                                    title={ "Daftar Pegawai" }
                                    icon={ <UsersIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "Worker" }
                                />
                            </TouchableHighlight>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("LogOutlete") }>
                                <ItemMenuDrawer
                                    title={ "Kelola Outlet" }
                                    icon={ <OfficeBuildingIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "LogOutlete" }
                                />
                            </TouchableHighlight> */}
                            {/* <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("LogCash") }>
                                <ItemMenuDrawer
                                    title={ "Kelola Kas" }
                                    icon={ <CurrencyDollarIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "LogCash" }
                                />
                            </TouchableHighlight> */}
                            {/* <ItemMenuDrawer
                                title={ "Inventaris" }
                                icon={ <ArchiveIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                            /> */}
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("Setting") }>
                                <ItemMenuDrawer
                                    title={ "Pengaturan" }
                                    icon={ <CogIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                                    path={ "Setting" }
                                />
                            </TouchableHighlight>
                            <ItemMenuDrawer
                                title={ "Bantuan" }
                                icon={ <SupportIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/> }
                            />
                        </ScrollView>
                    </Animated.View>
                </View>
            </GestureRecognizer>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        drawerStatus : state.drawerStatus,
        user: state.user
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Drawer)